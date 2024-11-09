@extends('admin.inc.app')
@section('title', 'Category Details')

@section('content')
<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">

            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3 class="text-lg py-3 px-4 font-semibold text-gray-800 dark:text-gray-200">Chi tiết danh mục:
                            {{ $category->name }}</h3>

                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <!-- Category Name -->
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Tên danh mục</span>
                                <p class="text-gray-800 dark:text-gray-300">{{ $category->name }}</p>
                            </label>

                            <!-- Parent Category -->
                            @if($category->parent)
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Danh mục cha</span>
                                    <p class="text-gray-800 dark:text-gray-300">{{ $category->parent->name }}</p>
                                </label>
                            @else
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Danh mục cha</span>
                                    <p class="text-gray-800 dark:text-gray-300">Không có danh mục cha</p>
                                </label>
                            @endif

                            <!-- Category Description -->
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Mô tả</span>
                                <p class="text-gray-800 dark:text-gray-300">{{ $category->description }}</p>
                            </label>

                            <!-- Category Thumbnail -->
                            @if($category->thumbnail)
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Ảnh danh mục</span>
                                    <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="Category Thumbnail"
                                        class="rounded-md w-32 h-32 object-cover mt-2">
                                </label>
                            @else
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Ảnh danh mục</span>
                                    <p class="text-gray-800 dark:text-gray-300">Không có ảnh</p>
                                </label>
                            @endif

                            <!-- Actions -->
                            <div class="mt-4">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Chỉnh sửa
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="inline-block ml-4"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Xóa danh mục
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection