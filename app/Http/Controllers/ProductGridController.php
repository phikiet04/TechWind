<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductGridController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm, có thể phân trang hoặc giới hạn số lượng nếu cần
        $products = Product::orderBy('created_at', 'desc')->paginate(12); // hoặc ->limit(12)->get();

        return view('grid', compact('products'));
    }
}
