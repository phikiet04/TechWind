<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Lấy danh sách đơn hàng với phân trang
        $orders = Order::with(['orderItems.product', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Hiển thị 5 đơn hàng mỗi trang

        // Lấy tất cả sản phẩm và danh mục
        $products = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        // Lấy tổng số người dùng
        $usersCount = User::count();

        // Tính số dư tài khoản cho các đơn hàng hoàn thành
        $accountBalance = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'completed'); // Lọc các đơn hàng hoàn thành
        })->sum(DB::raw('price * quantity'));

        // Lấy số lượng đơn hàng mới trong tháng vừa qua
        $newSalesCount = Order::where('status', 'completed')->where('created_at', '>', now()->subMonth())->count();

        // Lấy số lượng đơn hàng đang chờ xử lý
        $pendingContacts = Order::where('status', 'pending')->count();

        // Tính doanh thu và số lượng đơn hàng theo tháng (chỉ lấy trong năm hiện tại hoặc năm trước)
        $monthlySales = Order::where('status', 'completed')
            ->selectRaw('YEAR(orders.created_at) as year, MONTH(orders.created_at) as month, COUNT(*) as total_orders, SUM(order_items.price * order_items.quantity) as total_revenue')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [now()->subYear(), now()]) // Lấy dữ liệu trong vòng 1 năm qua
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc') // Sắp xếp theo năm tăng dần
            ->orderBy('month', 'asc') // Sắp xếp theo tháng trong năm
            ->get();

        // Chuyển đổi dữ liệu thành mảng thích hợp cho biểu đồ
        $months = [];
        $earningsData = [];

        // Lọc chỉ lấy tháng có doanh thu
        foreach ($monthlySales as $sale) {
            $months[] = $sale->year . '-' . str_pad($sale->month, 2, '0', STR_PAD_LEFT); // Chuẩn hóa tháng (01, 02, ..., 12)
            $earningsData[] = $sale->total_revenue;
        }

        // Truyền dữ liệu vào view
        return view('admin.dashboard.index', compact(
            'products',
            'categories',
            'usersCount',
            'accountBalance',
            'newSalesCount',
            'pendingContacts',
            'orders',
            'months',
            'earningsData'
        ));
    }

}