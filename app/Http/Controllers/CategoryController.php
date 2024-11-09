<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Lấy tham số category_id từ URL (nếu có)
        $categoryId = $request->input('category_id');
        // Lấy tham số search từ URL (nếu có)
        $search = $request->input('search');

        // Khởi tạo category và products mặc định
        $category = null;
        $productsQuery = Product::query();

        if ($categoryId) {
            // Lấy danh mục từ database
            $category = Category::find($categoryId);

            // Nếu danh mục tồn tại, lọc sản phẩm theo category_id
            if ($category) {
                $productsQuery = $category->products()->with('reviews');
            } else {
                return redirect()->route('shop.index')->with('error', 'Danh mục không tồn tại');
            }
        }

        // Nếu có tìm kiếm, lọc sản phẩm theo từ khóa tìm kiếm
        if ($search) {
            $productsQuery = $productsQuery->where('name', 'like', '%' . $search . '%');
        }

        // Phân trang kết quả, sử dụng paginate thay vì get
        $products = $productsQuery->paginate(12);

        // Tính toán rating cho từng sản phẩm
        foreach ($products as $product) {
            $reviews = $product->reviews;
            $averageRating = $reviews->avg('rating'); // Tính trung bình rating cho sản phẩm
            $product->averageRating = $averageRating;
            $product->reviewCount = $reviews->count(); // Số lượng đánh giá của sản phẩm
        }

        // Lấy tất cả danh mục để hiển thị trên giao diện
        $categories = Category::all();

        // Trả về view với các sản phẩm, danh mục và ratings
        return view('grid', compact('products', 'categories', 'category', 'search'));
    }
}
