<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Variant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class VariantController extends Controller
{

    // Hiển thị form chỉnh sửa variant
    public function edit($id)
    {
        $variant = Variant::findOrFail($id);
        return view('admin.variants.edit', compact('variant'));
    }

    // Cập nhật variant
    public function update(Request $request, $id)
    {
        $request->validate([
            'color' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $variant = Variant::findOrFail($id);
        $variant->update($request->all());
        return redirect()->route('admin.variants.index')->with('success', 'Variant updated successfully.');
    }

    // Xóa variant
    public function destroy($id)
    {
        // Tìm biến thể theo ID
        $variant = Variant::findOrFail($id);

        // Lưu lại ID của sản phẩm mà biến thể thuộc về
        $productId = $variant->product_id;

        // Xóa biến thể
        $variant->delete();

        // Quay lại trang chỉnh sửa sản phẩm với thông báo thành công
        return redirect()->route('admin.products.index', $productId)
            ->with('success', 'Biến thể đã được xoá.');
    }

}
