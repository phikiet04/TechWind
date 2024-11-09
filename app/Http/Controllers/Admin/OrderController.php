<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        $sortField = $request->get('sort', 'created_at');  // mặc định sort theo ngày tạo
        $sortDirection = $request->get('direction', 'desc');  // mặc định theo thứ tự giảm dần

        // Lấy danh sách đơn hàng với phân trang và sắp xếp
        $orders = Order::with('user')  // Giả sử mỗi order có liên kết với bảng users
            ->orderBy($sortField, $sortDirection)
            ->paginate(10);

        return view('admin.orders.index', compact('orders', 'sortField', 'sortDirection'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Trả về view tạo đơn hàng mới (nếu cần)
        return view('admin.orders.create');
    }

    /**
     * Store a newly created order in storage.
     */


    /**
     * Display the specified order.
     */
    public function show($id)
    {
        try {
            // Lấy đơn hàng với các item liên quan (bao gồm variant)
            $order = Order::with('orderItems.variant', 'orderItems.product')
                ->findOrFail($id);

            return view('admin.orders.show', compact('order'));
        } catch (\Exception $e) {
            Log::error("Error fetching order details for order ID: " . $id, ['error' => $e->getMessage()]);
            return redirect()->route('admin.orders.index')
                ->with('error', 'Unable to fetch order details.');
        }
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);

        // Tính tổng giá trị đơn hàng
        $total = $order->orderItems->sum('total_price');  // Tổng giá trị của tất cả các orderItems

        // Truyền tổng giá trị vào view
        return view('admin.orders.edit', compact('order', 'total'));
    }


    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->code = $request->input('code');
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->status = $request->input('status');

        $order->save();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->route('admin.orders.index')
                ->with('success', 'Order has been deleted successfully.');
        } catch (\Exception $e) {
            Log::error("Error deleting order ID: " . $id, ['error' => $e->getMessage()]);
            return redirect()->route('admin.orders.index')
                ->with('error', 'Unable to delete the order.');
        }
    }
}
