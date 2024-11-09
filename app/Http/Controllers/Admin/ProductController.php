<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy thông tin về cột và chiều sắp xếp từ query string, mặc định là 'id' và 'asc'
        $sortField = $request->input('sort', 'id'); // Mặc định sắp xếp theo ID
        $sortDirection = $request->input('direction', 'asc'); // Mặc định là tăng dần

        // Lấy thông tin sản phẩm cùng với category, sắp xếp theo trường đã chọn
        $products = Product::with('category')
            ->orderBy($sortField, $sortDirection)
            ->paginate(15);

        // Truyền các thông tin cần thiết vào view
        return view('admin.products.index', compact('products', 'sortField', 'sortDirection'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'view' => 'nullable|integer',
            'variant_color.*' => 'required|string',
            'variant_size.*' => 'required|string',
            'variant_price.*' => 'required|numeric|min:0',
            'variant_stock.*' => 'required|integer|min:0',
            'variant_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Calculate total stock based on variants
        $totalStock = array_sum($request->variant_stock);
        $status = $totalStock > 0 ? 'in stock' : 'out of stock';

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->variant_price[0], // Using the first variant price
            'view' => $request->view ?? 0,
            'status' => $status,
            'category_id' => $request->category_id,
        ]);

        // Handle each variant
        foreach ($request->variant_color as $index => $color) {
            $variant = new Variant();
            $variant->product_id = $product->id;

            // Store variant image if exists
            if ($request->hasFile(key: 'variant_image.' . $index)) {
                $variant->image = $request->file('variant_image.' . $index)->store('images/variants', 'public');
            }

            $variant->color = $color;
            $variant->size = $request->variant_size[$index];
            $variant->price = $request->variant_price[$index];
            $variant->stock = $request->variant_stock[$index];
            $variant->save();
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Get all categories
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'view' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'variant_color.*' => 'required|string',
            'variant_size.*' => 'required|string',
            'variant_price.*' => 'required|numeric|min:0',
            'variant_stock.*' => 'required|integer|min:0',
            'variant_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'variant_id.*' => 'nullable|exists:variants,id', // Validation for variant_id
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update product information
        $product->name = $request->input('name');
        $product->description = $request->input('description');

        // Handle product image upload (if present)
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image && \Storage::exists('public/' . $product->image)) {
                \Storage::delete('public/' . $product->image);
            }

            // Store new image
            $product->image = $request->file('image')->store('images/products', 'public');
        }

        // Update product's view and category_id
        $product->view = $request->input('view') ?? 0;
        $product->category_id = $request->input('category_id');

        // Calculate total stock based on variants and update status
        $totalStock = array_sum($request->variant_stock);
        $product->status = $totalStock > 0 ? 'in stock' : 'out of stock';

        $product->save(); // Save product changes

        // Update variants
        foreach ($request->variant_color as $index => $color) {
            $variantId = $request->input("variant_id.$index"); // Get the variant ID if exists

            // Find the existing variant or create a new one
            $variant = $variantId ? Variant::find($variantId) : new Variant();
            $variant->product_id = $product->id; // Set product ID for variant

            // Handle variant image upload if present
            if ($request->hasFile('variant_image.' . $index)) {
                // Delete old image if variant exists and old image exists
                if ($variant->image && \Storage::exists('public/' . $variant->image)) {
                    \Storage::delete('public/' . $variant->image);
                }

                // Store new image for the variant
                $variant->image = $request->file('variant_image.' . $index)->store('images/variants', 'public');
            } elseif (!$variantId) {
                // If variant is new and no image provided, we clear the image field
                $variant->image = null;
            }

            // Update variant details (color, size, price, stock)
            $variant->color = $color;
            $variant->size = $request->variant_size[$index];
            $variant->price = $request->variant_price[$index];
            $variant->stock = $request->variant_stock[$index];

            $variant->save(); // Save or update variant
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }



}
