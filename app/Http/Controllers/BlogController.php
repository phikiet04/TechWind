<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Hiển thị danh sách bài viết
        $products = Product::all(); //product wishlist
        $blogs = Blog::paginate(12); // Lấy 12 bài viết trên mỗi trang
        return view('blog', compact('blogs', 'products'));
    }

    // Hiển thị chi tiết một bài viết
    public function show($id)
    {
        $products = Product::all(); //product wishlist
        $blog = Blog::findOrFail($id); // Tìm bài viết theo ID
        return view('blog-detail', compact('blog', 'products'));
    }
}
