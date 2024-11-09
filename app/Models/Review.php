<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Các thuộc tính có thể được gán giá trị
    protected $fillable = ['product_id', 'user_id', 'rating', 'comment'];

    /**
     * Định nghĩa mối quan hệ với Product (một review thuộc về một product)
     */
    // app/Models/Review.php
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Tính điểm đánh giá trung bình của sản phẩm
     *
     * @param int $productId
     * @return float
     */
    public static function getAverageRating($productId)
    {
        $avgRating = self::where('product_id', $productId)->avg('rating');
        return $avgRating ? $avgRating : 0; // Trả về 0 nếu không có đánh giá
    }

    /**
     * Tính tổng số lượng đánh giá của sản phẩm
     *
     * @param int $productId
     * @return int
     */
    public static function getReviewCount($productId)
    {
        // Tính tổng số lượng đánh giá của sản phẩm theo ID
        return self::where('product_id', $productId)->count();
    }
}
