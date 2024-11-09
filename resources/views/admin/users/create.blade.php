@extends('admin.inc.app')
@section('title', 'Create User')

@section('content')
<div class="flex flex-col flex-1 w-full">
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">

            <!-- Create User Form -->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3 class="text-lg py-3 px-4 font-semibold text-gray-800 dark:text-gray-200">Tạo người dùng</h3>
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                                <!-- Email -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                                    <input type="email"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập email" name="email" value="{{ old('email') }}" required />
                                    @if ($errors->has('email'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('email') }}</p>
                                    @endif
                                </label>

                                <!-- Name -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Tên người dùng</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập tên người dùng" name="name" value="{{ old('name') }}"
                                        required />
                                    @if ($errors->has('name'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('name') }}</p>
                                    @endif
                                </label>

                                <!-- Password -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Mật khẩu</span>
                                    <input type="password"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập mật khẩu" name="password" required />
                                    @if ($errors->has('password'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('password') }}</p>
                                    @endif
                                </label>

                                <!-- Password Confirmation -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Xác nhận mật khẩu</span>
                                    <input type="password"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Xác nhận mật khẩu" name="password_confirmation" required />
                                    @if ($errors->has('password_confirmation'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('password_confirmation') }}
                                        </p>
                                    @endif
                                </label>

                                <!-- Role -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Quyền</span>
                                    <select
                                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="role" required>
                                        <option value="">Chọn quyền</option>
                                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('role') }}</p>
                                    @endif
                                </label>

                                <!-- Address (User Meta) -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Địa chỉ</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập địa chỉ" name="address" value="{{ old('address') }}" />
                                    @if ($errors->has('address'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('address') }}</p>
                                    @endif
                                </label>

                                <!-- Phone (User Meta) -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Số điện thoại</span>
                                    <input type="text"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        placeholder="Nhập số điện thoại" name="phone" value="{{ old('phone') }}" />
                                    @if ($errors->has('phone'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('phone') }}</p>
                                    @endif
                                </label>

                                <!-- Image Upload -->
                                <label class="block text-sm mb-4">
                                    <span class="text-gray-700 dark:text-gray-400">Ảnh (tùy chọn)</span>
                                    <input type="file" name="image" accept="image/*" id="image"
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" />
                                    @if ($errors->has('image'))
                                        <p class="text-red-600 text-sm mt-1">{{ $errors->first('image') }}</p>
                                    @endif
                                </label>

                                <!-- Image Preview -->
                                <div id="image-preview" class="mt-2">
                                    <img id="preview-image" src="#" alt="Image Preview"
                                        class="hidden w-32 h-32 object-cover rounded-md" />
                                </div>

                                <!-- Submit Button -->
                                <div
                                    class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                                    <div
                                        class="px-2 py-4 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                        <button type="submit" class="w-full custom-border">
                                            Tạo người dùng
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
</div>

<script>
    // JavaScript to preview the uploaded image
    document.getElementById('image').addEventListener('change', function (event) {
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
@endsection