@extends('admin.inc.app')
@section('title', 'Edit Product')

@section('content')

<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3 class="text-lg py-3 px-4 font-semibold text-gray-800 dark:text-gray-200">Chỉnh sửa sản phẩm
                        </h3>

                        <form id="productForm" action="{{ route('admin.products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                <!-- Tên sản phẩm -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Tên sản phẩm</span>
                                    <input type="text" name="name" id="name"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        value="{{ old('name', $product->name) }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </label>

                                <!-- Mô tả -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Mô tả</span>
                                    <textarea name="description" id="description" rows="3"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-textarea">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </label>

                                <!-- Danh mục -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Danh mục</span>
                                    <select name="category_id" id="category_id"
                                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        required>
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>

                                <!-- Biến thể sản phẩm -->
                                <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Biến thể sản
                                    phẩm</h5>
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Ảnh</th>
                                            <th class="px-4 py-3">Màu sắc</th>
                                            <th class="px-4 py-3">Size</th>
                                            <th class="px-4 py-3">Giá</th>
                                            <th class="px-4 py-3">Số lượng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="variantContainer">
                                        @foreach ($product->variants as $variant)
                                            <tr class="border">
                                                <input type="hidden" name="variant_id[]" value="{{ $variant->id }}">
                                                <!-- Ảnh biến thể -->
                                                <td class="align-middle text-center border">
                                                    <!-- Hiển thị ảnh nếu có -->
                                                    @if ($variant->image)
                                                        <div class="image-container flex justify-center"
                                                            style="position: relative;">
                                                            <img src="{{ asset('storage/' . $variant->image) }}"
                                                                class="flex justify-center" alt="Variant Image"
                                                                style="width: 75px; height: auto; cursor: pointer;"
                                                                onclick="triggerFileInput({{ $variant->id }})">
                                                            <!-- Hidden input file -->
                                                            <input type="file" name="variant_image[]" accept="image/*"
                                                                class="form-control mt-2 hidden"
                                                                id="file-input-{{ $variant->id }}"
                                                                onchange="previewImage(event, {{ $variant->id }})">
                                                        </div>
                                                    @else
                                                        <!-- Nếu không có ảnh, hiển thị input để chọn tệp -->
                                                        <input type="file" name="variant_image[]" accept="image/*"
                                                            class="form-control"
                                                            onchange="previewImage(event, '{{ $variant->id }}')">
                                                        <div class="image-container"
                                                            style="position: relative; width: 100px; height: 100px; overflow: hidden;">
                                                            <img id="variant-image-{{ $variant->id }}"
                                                                src="{{ asset('storage/' . $variant->image) }}"
                                                                alt="Variant Image" class="variant-image"
                                                                style="object-fit: cover; width: 100%; height: 100%;">
                                                        </div>
                                                    @endif
                                                </td>

                                                <!-- Màu sắc -->
                                                <td class="align-middle border">
                                                    <input type="text" name="variant_color[]"
                                                        value="{{ old('variant_color.' . $loop->index, $variant->color) }}"
                                                        class="form-control" required>
                                                </td>

                                                <!-- Size -->
                                                <td class="align-middle border">
                                                    <input type="text" name="variant_size[]"
                                                        value="{{ old('variant_size.' . $loop->index, $variant->size) }}"
                                                        class="form-control" required>
                                                </td>

                                                <!-- Giá -->
                                                <td class="align-middle text-center border">
                                                    <input type="number" name="variant_price[]"
                                                        value="{{ old('variant_price.' . $loop->index, $variant->price) }}"
                                                        class="form-control" min="0" step="0.01" required>
                                                </td>

                                                <!-- Số lượng -->
                                                <td class="align-middle text-center border">
                                                    <input type="number" name="variant_stock[]"
                                                        value="{{ old('variant_stock.' . $loop->index, $variant->stock) }}"
                                                        class="form-control" min="0" required>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Thêm biến thể mới -->
                                <button type="button" class="btn btn-secondary mt-4" id="addVariant">Thêm biến
                                    thể</button>

                                <!-- Nút submit -->
                                <div
                                    class="mt-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                                    <div
                                        class="px-2 py-4 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                        <button type="submit" class="w-full custom-border">Cập nhật sản phẩm</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function triggerFileInput(variantId) {
        const inputFile = document.getElementById(`file-input-${variantId}`);
        inputFile.click();  // Kích hoạt input file khi nhấn vào ảnh
    }

    // Xem trước ảnh khi người dùng chọn file mới
    function previewImage(event, variantId) {
        const inputFile = event.target;
        const imageContainer = document.getElementById(`file-input-${variantId}`).closest('.image-container');
        const imageElement = imageContainer.querySelector('.variant-image');

        const file = inputFile.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Cập nhật ảnh mới
                imageElement.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    document.getElementById('addVariant').addEventListener('click', function () {
        const variantContainer = document.getElementById('variantContainer');
        const newVariantRow = document.createElement('tr');
        newVariantRow.classList.add('border');
        newVariantRow.innerHTML = `
        <td class="align-middle text-center border">
            <input style="max-width:85px" type="file" name="variant_image[]" accept="image/*" class="form-control">
        </td>
        <td class="align-middle border">
            <input type="text" name="variant_color[]" class="form-control" required>
        </td>
        <td class="align-middle border">
            <input type="text" name="variant_size[]" class="form-control" required>
        </td>
        <td class="align-middle text-center border">
            <input type="number" name="variant_price[]" class="form-control" min="0" step="0.01" required>
        </td>
        <td class="align-middle text-center border">
            <input type="number" name="variant_stock[]" class="form-control" min="0" required>
        </td>
        
    `;
        variantContainer.appendChild(newVariantRow);
    });

    // Xóa biến thể
    document.getElementById('variantContainer').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-variant')) {
            event.target.closest('tr').remove();
        }
    });

</script>

@endsection