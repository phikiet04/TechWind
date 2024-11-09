@extends('admin.inc.app')
@section('title', 'Danh sách Banner')

@section('content')
<div class="container relative">
    <h1 class="text-2xl font-semibold mb-4">Danh sách Banner</h1>

    <!-- Display success message if available -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div id="grid" class="md:flex w-full justify-center mx-auto mt-4">
        @if ($banners->count() == 1)
            <!-- Hiển thị 1 banner và 2 cái mặc định -->
            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('storage/' . $banners[0]->thumbnail) }}"
                        class="group-hover:scale-110 duration-500 cursor-pointer" alt="{{ $banners[0]->name }}"
                        data-bs-toggle="modal" data-bs-target="#changeImageModal{{ $banners[0]->id }}" />
                    <div class="absolute bottom-4 start-4">
                        <a href="#"
                            class="text-xl font-semibold hover:text-indigo-600 duration-500">{{ $banners[0]->name }}</a>
                    </div>
                    <!-- Edit Button -->
                    <a href="{{ route('admin.banners.edit', $banners[0]->id) }}"
                        class="absolute top-2 right-2 bg-blue-600 text-white px-4 py-2 rounded-md">
                        Edit
                    </a>
                </div>
            </div>
            <!-- Các Banner Mặc Định -->
            <div>
                <div class="md:w-1/2 p-3 picture-item">
                    <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                        <img src="{{ asset('assets/images/shop/hoodie.jpg') }}" class="group-hover:scale-110 duration-500"
                            alt="Hoodies" />
                        <div class="absolute bottom-4 start-4">
                            <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">Hoodies</a>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 p-3 picture-item">
                    <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                        <img src="{{ asset('assets/images/shop/beanie.jpg') }}" class="group-hover:scale-110 duration-500"
                            alt="Beanies" />
                        <div class="absolute bottom-4 start-4">
                            <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">Beanies for Man &
                                Women</a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($banners->count() == 2)
            <!-- Hiển thị 2 banner từ database và 1 cái mặc định -->
            @foreach ($banners as $banner)
                <div class="md:w-1/2 p-3 picture-item">
                    <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                        <img src="{{ asset('storage/' . $banner->thumbnail) }}"
                            class="group-hover:scale-110 duration-500 cursor-pointer" alt="{{ $banner->name }}"
                            data-bs-toggle="modal" data-bs-target="#changeImageModal{{ $banner->id }}" />
                        <div class="absolute bottom-4 start-4">
                            <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">{{ $banner->name }}</a>
                        </div>
                        <!-- Edit Button -->
                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                            class="absolute top-2 right-2 bg-blue-600 text-white px-4 py-2 rounded-md">
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('assets/images/shop/glasses.jpg') }}" class="group-hover:scale-110 duration-500"
                        alt="Glasses" />
                    <div class="absolute bottom-4 start-4">
                        <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">Glasses</a>
                    </div>
                </div>
            </div>
        @elseif ($banners->count() == 3)
            <!-- Hiển thị tất cả 3 banner từ database -->
            @foreach ($banners as $banner)
                <div class="md:w-1/2 p-3 picture-item">
                    <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                        <img src="{{ asset('storage/' . $banner->thumbnail) }}"
                            class="group-hover:scale-110 duration-500 cursor-pointer" alt="{{ $banner->name }}"
                            data-bs-toggle="modal" data-bs-target="#changeImageModal{{ $banner->id }}" />
                        <div class="absolute bottom-4 start-4">
                            <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">{{ $banner->name }}</a>
                        </div>
                        <!-- Edit Button -->
                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                            class="absolute top-2 right-2 bg-blue-600 text-white px-4 py-2 rounded-md">
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Hiển thị các banner mặc định nếu không có banner nào -->
            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('assets/images/shop/hoodie.jpg') }}" class="group-hover:scale-110 duration-500"
                        alt="Hoodies" />
                    <div class="absolute bottom-4 start-4">
                        <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">Hoodies</a>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('assets/images/shop/beanie.jpg') }}" class="group-hover:scale-110 duration-500"
                        alt="Beanies" />
                    <div class="absolute bottom-4 start-4">
                        <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">Beanies for Man &
                            Women</a>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 p-3 picture-item">
                <div class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img src="{{ asset('assets/images/shop/glasses.jpg') }}" class="group-hover:scale-110 duration-500"
                        alt="Glasses" />
                    <div class="absolute bottom-4 start-4">
                        <a href="#" class="text-xl font-semibold hover:text-indigo-600 duration-500">Glasses</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal for changing the image -->
@foreach ($banners as $banner)
    <div class="modal fade" id="changeImageModal{{ $banner->id }}" tabindex="-1"
        aria-labelledby="changeImageModalLabel{{ $banner->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeImageModalLabel{{ $banner->id }}">Thay đổi hình ảnh banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.banners.updateImage', $banner->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Preview the current image -->
                        <div class="form-group mb-3 text-center">
                            <label for="thumbnail" class="text-sm font-medium">Hình ảnh hiện tại</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $banner->thumbnail) }}" id="current-image-{{ $banner->id }}"
                                    class="img-fluid rounded" alt="current image" style="max-width: 200px;">
                            </div>
                            <input type="file" name="thumbnail" id="thumbnail{{ $banner->id }}" class="form-control"
                                onchange="previewImage(event, '{{ $banner->id }}')" required>
                            @error('thumbnail')
                                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Lưu hình ảnh mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section('scripts')
<script>
    // Hàm để xem trước hình ảnh khi người dùng chọn ảnh mới
    function previewImage(event, bannerId) {
        var reader = new FileReader();
        reader.onload = function () {
            var previewImage = document.getElementById('current-image-' + bannerId);
            previewImage.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection