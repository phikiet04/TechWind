<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function submitReview(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        try {
            $validated = $request->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'nullable|string|max:500',
            ]);

            $review = new Review();
            $review->product_id = $product->id;
            $review->user_id = Auth::id();
            $review->rating = $request->input('rating');
            $review->comment = $request->input('comment');
            $review->save();

            $averageRating = $product->reviews()->avg('rating');
            $reviewCount = $product->reviews()->count();

            return response()->json([
                'average_rating' => $averageRating,
                'review_count' => $reviewCount,
            ]);

        } catch (\Exception $e) {
            // Log lỗi để xem chi tiết
            \Log::error("Review submission error: " . $e->getMessage());
            return response()->json(['error' => 'There was an error submitting your review.'], 500);
        }
    }


}
