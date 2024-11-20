@extends('layouts.app')

@section('title', 'Account Page')

@section('content')
<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold">Tài khoản của tôi</h3>
        </div><!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                    <a href="index-shop.html">Techwind</a>
                </li>
                <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                        class="uil uil-angle-right-b"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">My Account
                </li>
            </ul>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container">
        <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-[30px]">
            <div class="lg:col-span-3 md:col-span-5">
                <div class="flex items-center">
                    <img src=""
                        alt="User Avatar" class="size-16 rounded-2xl shadow dark:shadow-gray-800" alt="User Image">
                    <div class="ms-2 display-ruby">
                        <p class="font-semibold text-slate-400">Hello,</p>
                        <h5 class="text-lg font-semibold">{{ $user->name }}</h5>
                    </div>
                </div>
            </div><!--end col-->


            <div class="lg:col-span-9 md:col-span-7">

            </div><!--end col-->

            <div class="lg:col-span-3 md:col-span-5">
                <div class="sticky top-20">
                    <ul class="flex-column p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md"
                        id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li role="presentation">
                            <button
                                class="px-4 py-2 text-start text-base font-semibold rounded-md w-full hover:text-indigo-600 duration-500"
                                id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                aria-controls="dashboard" aria-selected="true"><i
                                    class="uil uil-dashboard text-[20px] me-2 align-middle"></i> Dashboard</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                id="order-tab" data-tabs-target="#order" type="button" role="tab" aria-controls="order"
                                aria-selected="false"><i class="uil uil-list-ul text-[20px] me-2 align-middle"></i>
                                Orders</button>
                        </li>

                        <li role="presentation">
                            <button
                                class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                id="address-tab" data-tabs-target="#address" type="button" role="tab"
                                aria-controls="address" aria-selected="false"><i
                                    class="uil uil-map-marker text-[20px] me-2 align-middle"></i> Addresses</button>
                        </li>
                        <li role="presentation">
                            <button
                                class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                id="accountdetail-tab" data-tabs-target="#accountdetail" type="button" role="tab"
                                aria-controls="accountdetail" aria-selected="false"><i
                                    class="uil uil-user text-[20px] me-2 align-middle"></i> Account Details</button>
                        </li>
                        <li role="presentation">

                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-indigo-600 dark:hover:text-white">
                                    <i class="uil uil-sign-out-alt align-middle me-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div><!--end col-->

            <div class="lg:col-span-9 md:col-span-7">
                <div id="myTabContent" class="p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md">
                    <div class="" id="dashboard" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="text-slate-400 font-semibold">Hello <span
                                class="text-slate-900 dark:text-white">{{ $user->name }}.</span>

                        </p>
                        <span class="text-sm text-slate-500 dark:text-slate-300">
                            Thank you for being a part of our community.
                        </span>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>

                    <!-- Orders Tab -->
                    <div class="hidden" id="order" role="tabpanel" aria-labelledby="order-tab">
    <div class="relative overflow-x-auto shadow dark:shadow-gray-800 rounded-md">
        <table class="w-full text-start text-slate-500 dark:text-slate-400">
            <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                <tr class="text-start">
                    <th scope="col" class="px-2 py-3 text-start">Order no.</th>
                    <th scope="col" class="px-2 py-3 text-start">Date</th>
                    <th scope="col" class="px-2 py-3 text-start">Status</th>
                    <th scope="col" class="px-2 py-3 text-start">Total</th>
                    <th scope="col" class="px-2 py-3 text-start">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user->orders as $order)
                    <tr class="bg-white dark:bg-slate-900 text-start">
                        <th class="px-2 py-3 text-start" scope="row">{{ $order->code }}</th>
                        <td class="px-2 py-3 text-start">{{ $order->created_at->format('jS F Y') }}</td>
                        <td class="px-2 py-3 text-start">
                             <span class="px-2 py-1 font-semibold leading-tight 
                            @if($order->status == 'pending') bg-pending 
                            @elseif($order->status == 'processing') bg-processing
                            @elseif($order->status == 'canceled') bg-canceled
                            @elseif($order->status == 'completed') bg-completed
                            @else bg-default 
                            @endif rounded-full dark:bg-gray-700 dark:text-gray-100 bg-status">
                            {{ ucfirst($order->status) }}
                        </span>
                        </td>
                        <td class="px-2 py-3 text-start">
                            $ {{ number_format($order->orderItems->sum('total_price'), 2) }}
                            <span class="text-slate-400">for {{ $order->orderItems->sum('quantity') }} 
                                item{{ $order->orderItems->sum('quantity') > 1 ? 's' : '' }}</span>
                        </td>
                        <td class="px-2 py-3 text-start">
                            <!-- View Button -->
                            <a href="javascript:void(0)" class="text-indigo-600 view-order-btn"
                                data-order-id="{{ $order->id }}">Chi tiết<i
                                    class="uil uil-arrow-right"></i>
                            </a>

                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-4">
                                     <i class="uil uil-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-slate-900">
                        <td colspan="5" class="px-2 py-3 text-center text-slate-400">
                            You have no orders yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Order Modal -->
<div id="order-modal"
    class="fixed inset-0 flex justify-center items-center bg-gradient-to-b from-transparent to-black z-50 hidden">
    <div
        class="bg-white p-6 rounded-md sm:w-full sm:custom-sm md:w-full md:custom-md lg:w-1/2 lg:custom-lg xl:w-1/4 xl:custom-xl">
        <h3 class="text-xl font-semibold" id="order-modal-title">Order Details</h3>
        <div id="order-details">
            <!-- Order details will be displayed here -->
        </div>
        <button id="close-modal"
            class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md">Close</button>
    </div>
</div>


                    <div class="hidden" id="address" role="tabpanel" aria-labelledby="address-tab">
                        <div class="mt-6">
                            <div class="max-w-full md:px-3">
                                <!-- Hiển thị thông tin địa chỉ -->
                                <div class="flex items-center mb-4 justify-between">
                                    <h5 class="text-xl font-semibold">Address:</h5>
                                    <a href="#" class="text-indigo-600 text-lg" id="edit-address-button"><i
                                            class="uil uil-edit align-middle"></i></a>
                                </div>

                                <!-- Thông tin địa chỉ và số điện thoại -->
                                <div class="pt-4 border-t border-gray-100 dark:border-gray-700" id="address-info">

                                    <ul class="list-none">
                                        <li class="flex">
                                            <h5 class="text-lg font-semibold mb-2">Địa chỉ:</h5>
                                        </li>

                                        <li class="flex">
                                            <i class="uil uil-map-marker text-lg me-2"></i>
                                            <p class="text-slate-400">
                                                {{$user->userMeta->address ?? 'No address provided'}}
                                            </p>
                                        </li>
                                        <li class="flex">
                                            <h5 class="text-lg font-semibold mb-2">Số điện thoại:</h5>
                                        </li>

                                        <li class="flex mt-1">
                                            <i class="uil uil-phone text-lg me-2"></i>
                                            <p class="text-slate-400">
                                                {{$user->userMeta->phone ?? 'No phone number provided'}}
                                            </p>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Form chỉnh sửa địa chỉ -->
                                <form id="address-form"
                                    action="{{ route('users.update.address', ['id' => $user->id]) }}" method="POST"
                                    class="hidden mt-4">
                                    @csrf
                                    @method('PUT')

                                    <!-- Hidden User ID -->
                                    <input type="hidden" name="id" value="{{$user->id}}">

                                    <!-- Address -->
                                    <div class="mb-4">
                                        <label for="address" class="font-semibold">Your Address:</label>
                                        <input type="text" name="address" id="address"
                                            value="{{ old('address', $user->userMeta->address ?? '') }}"
                                            class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                            required>
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-4">
                                        <label for="phone" class="font-semibold">Your Phone:</label>
                                        <input type="text" name="phone" id="phone"
                                            value="{{ old('phone', $user->userMeta->phone ?? '') }}"
                                            class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                            required>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-4">
                                        <button type="submit"
                                            class="bg-indigo-600 text-white px-5 py-2 rounded-md w-full">Save
                                            Address</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <div class="hidden" id="accountdetail" role="tabpanel" aria-labelledby="accountdetail-tab">
                        <h5 class="text-lg font-semibold mb-4">Personal Detail:</h5>
                        <form action="{{ route('users.update.profile', ['id' => $user->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="grid grid-cols-1 gap-5">
                                <div>
                                    <label class="form-label font-medium">Name:</label>
                                    <div class="form-icon relative mt-2">
                                        <i data-feather="user" class="size-4 absolute top-3 start-4"></i>
                                        <input type="text"
                                            class="form-input ps-12 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            placeholder="Full Name" id="name" name="name"
                                            value="{{ old('name', $user->name) }}">
                                    </div>
                                    @error('name')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="form-label font-medium">Your Email:</label>
                                    <div class="form-icon relative mt-2">
                                        <i data-feather="mail" class="size-4 absolute top-3 start-4"></i>
                                        <input type="email"
                                            class="form-input ps-12 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            placeholder="Email" name="email" value="{{ old('email', $user->email) }}">
                                    </div>
                                    @error('email')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div>
                                    <label class="form-label font-medium">New Password:</label>
                                    <div class="form-icon relative mt-2">
                                        <i data-feather="key" class="size-4 absolute top-3 start-4"></i>
                                        <input type="password"
                                            class="form-input ps-12 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            placeholder="New password" name="password">
                                    </div>
                                    @error('password')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password Confirmation -->
                                <div>
                                    <label class="form-label font-medium">Confirm New Password:</label>
                                    <div class="form-icon relative mt-2">
                                        <i data-feather="key" class="size-4 absolute top-3 start-4"></i>
                                        <input type="password"
                                            class="form-input ps-12 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            placeholder="Confirm new password" name="password_confirmation">
                                    </div>
                                    @error('password_confirmation')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Avatar Upload -->
                                <div>
                                    <label class="form-label font-medium">Profile Picture (Avatar):</label>
                                    <div class="form-icon relative mt-2">
                                        <!-- Avatar Image Preview -->
                                        @if($user->userMeta && $user->userMeta->avatar)
                                            <div class="mb-2">
                                                <img id="avatar-preview"
                                                    src="{{ asset('storage/' . $user->userMeta->avatar) }}"
                                                    alt="Current Avatar" class="w-20 h-20 rounded-full object-cover ">
                                            </div>
                                        @else
                                            <div class="mb-2">
                                                <img id="avatar-preview" src="" alt="Current Avatar"
                                                    class="w-20 h-20 rounded-2xl object-cover" style="display:none;">
                                            </div>
                                        @endif

                                        <input type="file"
                                            class="form-input w-full py-1 px-0 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            name="avatar" id="avatar-upload">
                                    </div>
                                    @error('avatar')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <input type="submit" value="Save Changes"
                                    class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md mt-5">
                            </div>
                        </form>
                    </div>


                </div>
            </div><!--end col-->
        </div><!--end grid-->
    </div><!--end container-->
<script>
    // JavaScript confirmation dialog before deleting
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?');
    }
</script>
</section><!--end section-->
<!-- End -->
@endsection