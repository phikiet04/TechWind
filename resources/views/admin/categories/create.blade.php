@extends('admin.inc.app')
@section('title', 'Create Category')

@section('content')
<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">

            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3 class="text-lg py-3 px-4 font-semibold text-gray-800 dark:text-gray-200">Tạo danh mục mới
                        </h3>
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                <!-- Parent Category -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Danh mục cha (Không bắt buộc)</span>
                                    <select
                                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="parent_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <!-- Category Name -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Tên danh mục</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Enter category name" name="name" required />
                                </label>

                                <!-- Description -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Mô tả</span>
                                    <textarea
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-textarea"
                                        rows="3" placeholder="Enter a description for the category"
                                        name="description"></textarea>
                                </label>
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Ảnh</span>
                                    <input type="file" name="thumbnail" accept="image/*" id="thumbnail"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                </label>

                                <!-- Image Preview -->
                                <div id="image-preview" class="mt-2">
                                    <img id="preview-image" src="#" alt="Image Preview"
                                        class="hidden w-32 h-32 object-cover rounded-md" />
                                </div>

                                <div
                                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                                    <div
                                        class="px-2 py-4 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 ">
                                        <button type="submit" class="w-full custom-border">
                                            Tạo mới
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script>
        document.getElementById('thumbnail').addEventListener('change', function (event) {
            var reader = new FileReader();
            reader.onload = function () {
                var preview = document.getElementById('preview-image');
                preview.src = reader.result;
                preview.classList.remove('hidden'); // Show the image preview
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    </script>

</div>
@endsection