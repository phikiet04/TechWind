<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::limit(3)->get();

        // Lấy 8 sản phẩm mới nhất với variants
        $products = Product::with('variants', 'reviews')->orderBy('created_at', 'desc')->take(8)->get();
        foreach ($products as $product) {
            // Tính toán biến thể rẻ nhất
            $product->cheapestVariant = $product->variants->sortBy('price')->first();

            // Tính toán trung bình rating
            $reviews = $product->reviews;
            $averageRating = $reviews->avg('rating'); // Trung bình rating
            $product->averageRating = $averageRating;
            $product->reviewCount = $reviews->count(); // Số lượng đánh giá
        }


        $ratingProducts = Product::with('variants', 'reviews')
            ->get() // Lấy tất cả sản phẩm
            ->each(function ($product) {
                // Tính toán trung bình rating cho mỗi sản phẩm
                $reviews = $product->reviews;
                $averageRating = $reviews->avg('rating');
                $product->averageRating = $averageRating;
                $product->reviewCount = $reviews->count();
            })
            ->sortByDesc('averageRating') // Sắp xếp theo rating giảm dần
            ->take(4); // Lấy 4 sản phẩm có rating cao nhất
        // Tính toán trung bình rating cho sản phẩm phổ biến
        foreach ($ratingProducts as $product) {
            $reviews = $product->reviews;
            $averageRating = $reviews->avg('rating');
            $product->averageRating = $averageRating;
            $product->reviewCount = $reviews->count();
        }

        // Lấy 6 danh mục đầu tiên
        $categories = Category::withCount('products')  // Đếm số lượng sản phẩm trong mỗi danh mục
            ->orderByDesc('products_count')  // Sắp xếp theo số lượng sản phẩm giảm dần
            ->take(6)  // Lấy 6 danh mục có nhiều sản phẩm nhất
            ->get();
        

        // Lấy 4 sản phẩm cap nhap mới nhất với variants
        $recentProducts = Product::with('variants', 'reviews')
            ->orderBy('updated_at', 'desc')  // Sắp xếp theo ngày cập nhật (hoặc có thể theo lượt xem)
            ->take(4)  // Lấy 4 sản phẩm có hoạt động gần đây
            ->get();
        ;

        // Tính toán trung bình rating cho sản phẩm gần đây
        foreach ($recentProducts as $product) {
            $reviews = $product->reviews;
            $averageRating = $reviews->avg('rating');
            $product->averageRating = $averageRating;
            $product->reviewCount = $reviews->count();
        }

        // Tính doanh thu và số lượng đơn hàng theo tháng
        $monthlySales = Order::where('status', 'completed')
            ->selectRaw('YEAR(orders.created_at) as year, MONTH(orders.created_at) as month, SUM(order_items.price * order_items.quantity) as total_revenue')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [now()->subYear(), now()]) // Lấy dữ liệu trong vòng 1 năm qua
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc') // Sắp xếp theo năm và tháng
            ->orderBy('month', 'asc')
            ->get();

        // Chuyển dữ liệu thành mảng thích hợp cho biểu đồ
        $months = [];
        $earningsData = [];

        // Chuẩn hóa tháng và doanh thu
        foreach ($monthlySales as $sale) {
            $months[] = $sale->year . '-' . str_pad($sale->month, 2, '0', STR_PAD_LEFT); // Chuẩn hóa tháng (2023-01, 2023-02)
            $earningsData[] = $sale->total_revenue;
        }

        // Kiểm tra nếu không có sản phẩm nào
        if ($products->isEmpty() && $ratingProducts->isEmpty() && $recentProducts->isEmpty()) {
            return view('home')->with('message', 'No products available at the moment.');
        }

        // Trả về view với dữ liệu
        return view('home', compact(
            'products',
            'categories',
            'ratingProducts',
            'recentProducts',
            'months',
            'earningsData',
            'banners'
        ));
    }
}
