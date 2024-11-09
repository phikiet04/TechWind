<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function show($id)
    {
        // Lấy sản phẩm và các reviews của nó
        $product = Product::findOrFail($id);
        $reviews = $product->reviews;  // Lấy tất cả các review của sản phẩm chính

        // Tính toán trung bình rating và số lượng đánh giá
        $averageRating = $reviews->avg('rating'); // Trung bình rating
        $reviewCount = $reviews->count(); // Số lượng đánh giá

        // Lấy các sản phẩm liên quan (cùng category)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        // Trả về view với các dữ liệu cần thiết
        return view('item-detail', compact('product', 'reviews', 'relatedProducts', 'averageRating', 'reviewCount'));
    }

    public function storeRating(Request $request, $productId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($productId);

        // Lưu đánh giá vào bảng đánh giá (nếu có)
        $product->ratings()->create([
            'rating' => $validated['rating'],
            'user_id' => auth()->id(), // Nếu bạn cần theo dõi người dùng đánh giá
        ]);

        // Cập nhật lại điểm trung bình của sản phẩm
        $averageRating = $product->ratings()->avg('rating');
        $product->average_rating = $averageRating;
        $product->save();

        // Trả về phản hồi JSON hoặc chuyển hướng lại trang chi tiết sản phẩm
        return response()->json([
            'message' => 'Product rating saved!',
            'average_rating' => round($averageRating, 1),  // Lấy trung bình và làm tròn
        ]);
    }
}
