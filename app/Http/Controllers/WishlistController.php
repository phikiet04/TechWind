<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function add($id)
    {
        // Lưu sản phẩm vào session wishlist
        $wishlist = Session::get('wishlist', []);
        if (!in_array($id, $wishlist)) {
            $wishlist[] = $id; // Thêm sản phẩm vào wishlist
            Session::put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    public function showWishlist()
    {
        $wishlistIds = Session::get('wishlist', []);
        $products = Product::whereIn('id', $wishlistIds)->get();

        return view('wishlist', compact('products'));
    }
}
