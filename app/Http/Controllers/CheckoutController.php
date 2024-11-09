<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Variant;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;

class CheckoutController extends Controller
{
    public function index()
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = auth()->user();

        // Lấy thông tin từ UserMeta nếu người dùng đã đăng nhập
        $userMeta = $user ? $user->userMeta : null;

        // Lấy giỏ hàng của người dùng
        $cartItems = Cart::where('user_id', $user ? $user->id : null)->get();

        // Kiểm tra giỏ hàng trống
        if ($cartItems->isEmpty()) {
            Log::info('Giỏ hàng trống', ['user_id' => $user ? $user->id : null]);
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn trống!');
        }

        // Tính toán tổng tiền và thuế
        $subtotal = $this->calculateSubtotal($cartItems);
        $taxes = $subtotal * 0.1; // Thuế 10%
        $total = $subtotal + $taxes;

        // Log thông tin thanh toán
        Log::info('Tính toán tổng tiền', [
            'user_id' => $user ? $user->id : null,
            'subtotal' => $subtotal,
            'taxes' => $taxes,
            'total' => $total
        ]);

        // Trả về view với dữ liệu cần thiết
        return view('checkout', compact('cartItems', 'subtotal', 'taxes', 'total', 'userMeta', 'user'));
    }

    public function create(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        $user = auth()->user();

        // Ghi log khi người dùng chưa đăng nhập
        if (!$user) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'payment_method' => 'required|string',
            ]);

            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $address = $request->input('address');
            $userId = null;

            Log::info('Người dùng chưa đăng nhập. Yêu cầu nhập thông tin mới.', ['name' => $name, 'email' => $email, 'phone' => $phone, 'address' => $address]);
        } else {
            $userMeta = $user->userMeta;
            $name = $user->name;
            $email = $user->email;
            $phone = $userMeta->phone ?? $request->input('phone');
            $address = $userMeta->address ?? $request->input('address');
            $userId = $user->id;

            Log::info('Người dùng đã đăng nhập', ['user_id' => $userId, 'name' => $name, 'email' => $email, 'phone' => $phone, 'address' => $address]);
        }

        $cartItemsFromRequest = $request->input('cart_items');

        if (!is_array($cartItemsFromRequest) || count($cartItemsFromRequest) === 0) {
            Log::warning('Giỏ hàng trống khi tạo đơn hàng', ['user_id' => $userId]);
            return redirect()->route('cart')->with('error', 'Giỏ hàng của bạn trống!');
        }

        // Kiểm tra tồn kho các sản phẩm trong giỏ hàng
        foreach ($cartItemsFromRequest as $cartItemData) {
            $variant = Variant::findOrFail($cartItemData['variant_id']);
            $quantity = (int) $cartItemData['quantity'];

            // Ghi log về thông tin sản phẩm trong giỏ hàng
            Log::info('Kiểm tra sản phẩm trong giỏ hàng', [
                'variant_id' => $variant->id,
                'product_name' => $variant->product->name,
                'quantity' => $quantity,
                'available_stock' => $variant->stock
            ]);

            // Kiểm tra tồn kho
            if ($variant->stock < $quantity) {
                Log::error('Không đủ hàng trong kho cho sản phẩm', [
                    'product' => $variant->product->name,
                    'variant' => $variant->name,
                    'stock_available' => $variant->stock,
                    'quantity_requested' => $quantity
                ]);
                return redirect()->route('cart')->with('error', 'Không đủ hàng trong kho cho sản phẩm: ' . $variant->product->name . ' - ' . $variant->name);
            }
        }

        // Tính toán tổng tiền cho đơn hàng (bao gồm cả thuế)
        $totalAmount = $this->calculateSubtotalFromRequest($cartItemsFromRequest);
        $taxes = $totalAmount * 0.1; // Thuế 10%
        $total = $totalAmount + $taxes;

        Log::info('Tính toán tổng tiền đơn hàng', ['user_id' => $userId, 'subtotal' => $totalAmount, 'taxes' => $taxes, 'total' => $total]);

        // Tạo mã đơn hàng tự động
        $orderCode = 'ORD-' . strtoupper(Str::random(8));
        Log::info('Tạo mã đơn hàng mới', ['order_code' => $orderCode]);

        // Bắt đầu transaction
        DB::beginTransaction();

        try {
            // Tạo đơn hàng mới và lưu vào cơ sở dữ liệu
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'code' => $orderCode,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address
            ]);

            Log::info('Đơn hàng đã được tạo thành công', ['order_id' => $order->id, 'order_code' => $order->code]);

            // Thêm các sản phẩm vào bảng order_items và cập nhật stock
            foreach ($cartItemsFromRequest as $cartItemData) {
                $variant = Variant::findOrFail($cartItemData['variant_id']);
                $quantity = (int) $cartItemData['quantity'];
                $price = $variant->price * $quantity;

                // Cập nhật lại stock trong variant
                $variant->decrement('stock', $quantity);

                // Lưu thông tin size và color từ Variant vào order_items
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $variant->product_id,
                    'variant_id' => $variant->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $price,
                    'size' => $variant->size,   // Kiểm tra dữ liệu 'size'
                    'color' => $variant->color, // Kiểm tra dữ liệu 'color'
                ]);
                Log::info('Dữ liệu Variant', [
                    'variant_id' => $variant->id,
                    'size' => $variant->size,  // Kiểm tra size
                    'color' => $variant->color // Kiểm tra color
                ]);


                // Ghi log cho từng sản phẩm trong order_item
                Log::info('Thêm sản phẩm vào order_item', [
                    'order_id' => $order->id,
                    'variant_id' => $variant->id,
                    'size' => $variant->size,
                    'color' => $variant->color,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $price
                ]);
            }

            // Xóa giỏ hàng sau khi thanh toán thành công
            Cart::where('user_id', $userId)->delete();
            Log::info('Giỏ hàng đã được xóa sau khi thanh toán thành công', ['user_id' => $userId]);

            // Commit transaction
            DB::commit();

            return redirect()->route('checkout.success', ['order' => $order->id])
                ->with('success', 'Đơn hàng của bạn đã được tạo thành công! Mã đơn hàng: ' . $orderCode);
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi
            DB::rollback();

            Log::error('Lỗi khi tạo đơn hàng', ['error' => $e->getMessage()]);
            return redirect()->route('cart')->with('error', 'Đã có lỗi xảy ra khi tạo đơn hàng. Vui lòng thử lại!');
        }
    }



    // Phương thức tính tổng tiền cho giỏ hàng từ request
    private function calculateSubtotalFromRequest($cartItemsFromRequest)
    {
        $subtotal = 0;
        foreach ($cartItemsFromRequest as $cartItemData) {
            $variant = Variant::findOrFail($cartItemData['variant_id']);
            $subtotal += $variant->price * (int) $cartItemData['quantity'];
        }
        return $subtotal;
    }



    // Phương thức tính tổng tiền
    private function calculateSubtotal($cartItems)
    {
        return $cartItems->sum(function ($item) {
            return $item->variant->price * $item->quantity;
        });
    }

}
