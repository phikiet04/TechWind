<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Xử lý sắp xếp và phân trang
        $categories = $this->getCategories($request);
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');

        return view('admin.categories.index', compact('categories', 'sortField', 'sortDirection'));
    }

    /**
     * Get Categories with sorting and pagination.
     */
    private function getCategories(Request $request)
    {
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');

        return Category::with('parent') // Lấy thông tin danh mục cha
            ->orderBy($sortField, $sortDirection)
            ->paginate(15);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tốt hơn là tránh sử dụng `all()`, hãy chỉ lấy các danh mục cha
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // Make sure you import Log

    public function store(Request $request)
    {
        try {
            // Log thông tin request (bao gồm ảnh và các trường khác)
            Log::info('Category Store Request Data:', $request->all());

            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'parent_id' => 'nullable|exists:categories,id',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Hình ảnh là tùy chọn
            ]);

            // Tạo category data
            $categoryData = [
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
            ];

            // Kiểm tra ảnh và lưu vào thư mục thumbnails
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                try {
                    // Lưu ảnh vào thư mục 'thumbnails' trong storage/public
                    $imagePath = $image->store('thumbnails', 'public');
                    Log::info('Image uploaded successfully:', ['path' => $imagePath]);

                    // Gán giá trị đường dẫn ảnh vào thumbnail
                    $categoryData['thumbnail'] = 'thumbnails/' . basename($imagePath);
                } catch (\Exception $e) {
                    Log::error('Error uploading image:', ['error' => $e->getMessage()]);
                    $categoryData['thumbnail'] = null;  // Nếu có lỗi, để thumbnail null
                }
            } else {
                // Nếu không có ảnh, đặt thumbnail thành giá trị mặc định
                $categoryData['thumbnail'] = 'default-thumbnail.jpg';
                Log::info('No image uploaded. Using default thumbnail.');
            }


            // Log dữ liệu sẽ được lưu vào cơ sở dữ liệu
            Log::info('Category data to be stored:', $categoryData);

            // Tạo mới category với dữ liệu bao gồm ảnh (nếu có)
            Category::create($categoryData);
            Log::info('Category created successfully.');

            // Chuyển hướng với thông báo thành công
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');

        } catch (\Exception $e) {
            // Log và xử lý lỗi
            Log::error('Error creating category:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'An error occurred while creating the category.']);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Lấy danh mục và trả về view
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Lấy các danh mục cha để chọn
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Xác thực đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'parent_id' => 'nullable|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra ảnh, nếu có
        ]);

        // Lấy danh mục cần cập nhật
        $category = Category::findOrFail($id);

        // Cập nhật thông tin cơ bản (name, description, parent_id)
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'parent_id' => $request->input('parent_id'),
        ]);

        // Kiểm tra xem có ảnh mới không
        if ($request->hasFile('thumbnail')) {
            // Lưu ảnh mới vào thư mục thumbnails
            $image = $request->file('thumbnail');
            try {
                $imagePath = $image->store('thumbnails', 'public');  // Lưu ảnh vào thư mục public/thumbnails

                // Cập nhật trường thumbnail trong cơ sở dữ liệu
                $category->thumbnail = $imagePath;
                $category->save();  // Lưu lại thay đổi
            } catch (\Exception $e) {
                Log::error('Error uploading image during category update:', ['error' => $e->getMessage()]);
                // Nếu có lỗi, giữ nguyên ảnh cũ
            }
        }

        // Chuyển hướng và thông báo thành công
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm và xóa category
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
