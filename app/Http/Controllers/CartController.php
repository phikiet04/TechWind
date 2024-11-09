<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
        }


        $user = auth()->user(); // Lấy người dùng hiện tại
        $cartItems = Cart::where('user_id', $user->id)->get(); // Lấy tất cả sản phẩm trong giỏ hàng của người dùng

        if ($cartItems->isEmpty()) {
            // Nếu giỏ hàng trống
            return view('cart', compact('cartItems'))->with('error', 'Giỏ hàng của bạn trống!');
        }

        // Tính toán subtotal, taxes và total
        $subtotal = $cartItems->sum(function ($item) {
            return $item->variant->price * $item->quantity;
        });
        $taxes = $subtotal * 0.1; // Giả sử thuế là 10%
        $total = $subtotal + $taxes;

        // Truyền tất cả các biến vào view
        return view('cart', compact('cartItems', 'subtotal', 'taxes', 'total'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        $cartItem = Cart::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Sản phẩm không có trong giỏ hàng!'], 404);
        }

        // Kiểm tra số lượng không vượt quá tồn kho
        $variant = $cartItem->variant;
        if ($request->quantity > $variant->stock) {
            return response()->json(['message' => 'Số lượng yêu cầu vượt quá hàng tồn kho!'], 400);
        }

        // Cập nhật số lượng
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Giỏ hàng đã được cập nhật!']);
    }


    public function add(Request $request, $id)
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.'
            ], 401); // Trả về JSON với mã lỗi 401
        }

        // Lấy thông tin người dùng
        $user = auth()->user();

        // Tìm sản phẩm và biến thể với findOrFail để tự động trả về lỗi 404 nếu không tìm thấy
        $product = Product::findOrFail($id); // Tìm sản phẩm, sẽ tự động trả về 404 nếu không tồn tại
        $variantId = $request->input('variant_id');
        $variant = $product->variants()->findOrFail($variantId); // Kiểm tra và lấy biến thể


        // Kiểm tra xem sản phẩm còn hàng không
        if ($variant->stock <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm này hiện tại đã hết hàng.'
            ], 400); // Trả về thông báo hết hàng với mã lỗi 400
        }

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('variant_id', $variantId)
            ->first();

        // Nếu sản phẩm đã có trong giỏ hàng
        if ($cartItem) {
            // Giới hạn số lượng tối đa trong giỏ hàng
            $maxQuantity = 10;

            // Kiểm tra và cập nhật số lượng
            if ($cartItem->quantity < $maxQuantity) {
                $cartItem->quantity++;
                $cartItem->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Sản phẩm đã được thêm vào giỏ hàng.',
                    'cart_quantity' => $cartItem->quantity
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm đã đạt giới hạn số lượng trong giỏ hàng.'
            ], 400);
        }

        // Nếu sản phẩm chưa có trong giỏ, thêm sản phẩm mới vào giỏ hàng
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'variant_id' => $variantId,
            'quantity' => 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng.',
            'cart_quantity' => 1
        ]);
    }

    public function remove($id)
    {
        $user = auth()->user();
        $cartItem = Cart::where('user_id', $user->id)->where('id', $id)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Sản phẩm không có trong giỏ hàng!'], 404);
        }

        // Xóa sản phẩm khỏi giỏ hàng
        $cartItem->delete();

        return response()->json(['message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!']);
    }

}
