@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold">Checkout</h3>
        </div><!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                    <a href="index-shop.html">Techwind</a>
                </li>
                <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i
                        class="uil uil-angle-right-b"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">Checkout
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
            <div class="lg:col-span-8">
                <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                    <h3 class="text-xl leading-normal font-semibold">Billing address</h3>

                    <form action="{{ route('checkout.create') }}" method="POST">
                        @csrf
                        @foreach ($cartItems as $item)
                            <input type="hidden" name="cart_items[{{ $item->id }}][product_id]"
                                value="{{ $item->product_id }}">
                            <input type="hidden" name="cart_items[{{ $item->id }}][variant_id]"
                                value="{{ $item->variant_id }}">
                            <input type="hidden" name="cart_items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}">
                            <input type="hidden" name="cart_items[{{ $item->id }}][price]"
                                value="{{ $item->variant->price }}"> <!-- Thêm giá -->
                            
                            <input type="hidden" name="cart_items[{{ $item->id }}][variant_size]"
                                value="{{ $item->variant->size }}">

                            <input type="hidden" name="cart_items[{{ $item->id }}][variant_color]"
                                value="{{ $item->variant->color }}">


                            <!-- Tên biến thể -->
                        @endforeach

                        <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-5">
                            <!-- Tên người nhận -->
                            <div class="lg:col-span-12">
                                <label class="form-label font-semibold">Your Name : <span
                                        class="text-red-600">*</span></label>
                                <input type="text"
                                    class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                    placeholder="Your Name" id="name" name="name" value="{{ old('name', $user->name) }}"
                                    required="">
                            </div>

                            <!-- Email người nhận -->
                            <div class="lg:col-span-12">
                                <label class="form-label font-semibold">Your Email : <span
                                        class="text-red-600">*</span></label>
                                <input type="email"
                                    class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                    placeholder="Email" name="email" value="{{ old('email', $user->email) }}"
                                    required="">
                            </div>

                            <!-- Địa chỉ người nhận -->
                            <div class="lg:col-span-12">
                                <label class="form-label font-semibold">Address : <span
                                        class="text-red-600">*</span></label>
                                <input type="text"
                                    class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                    placeholder="Address" name="address"
                                    value="{{ old('address', $userMeta->address ?? '') }}" required="">
                            </div>

                            <!-- Phone người nhận -->
                            <div class="lg:col-span-12">
                                <label class="form-label font-semibold">Phone : <span
                                        class="text-red-600">*</span></label>
                                <input type="text"
                                    class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0 mt-2"
                                    placeholder="Phone" name="phone" value="{{ old('phone', $userMeta->phone ?? '') }}"
                                    required="">
                            </div>
                        </div>


                        <!-- Phương thức thanh toán -->
                        <h3 class="text-xl leading-normal font-semibold mt-6">Payment</h3>
                        <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-5">
                            <div class="lg:col-span-12">
                                <div class="block">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="payment_method" value="cod"
                                            checked>
                                        <span class="text-slate-400">Thanh toán khi nhận hàng (COD)</span>
                                    </label>
                                </div>

                                <div class="block mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="payment_method" value="momo">
                                        <span class="text-slate-400">Ví điện tử MoMo</span>
                                    </label>
                                </div>

                                <div class="block mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="payment_method" value="zalopay">
                                        <span class="text-slate-400">Ví điện tử ZaloPay</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="mt-4">
                            <input type="submit"
                                class="py-2 px-5 inline-block text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                                value="Continue to checkout">
                        </div>
                    </form>

                </div>

            </div><!--end col-->

            <div class="lg:col-span-4">
                <div class="p-6 rounded-md shadow dark:shadow-gray-800">
                    <div class="flex justify-between items-center">
                        <h5 class="text-lg font-semibold">Your Cart</h5>

                    </div>

                    <ul class="list-none shadow dark:shadow-gray-800 rounded-md">
                        <li class="flex justify-between p-4">
                            <span class="font-semibold text-lg">Subtotal :</span>
                            <span class="text-slate-400">${{ number_format($subtotal, 2) }}</span>
                        </li>
                        <li class="flex justify-between p-4 border-t border-gray-100 dark:border-gray-800">
                            <span class="font-semibold text-lg">Taxes :</span>
                            <span class="text-slate-400">${{ number_format($taxes, 2) }}</span>
                        </li>
                        <li
                            class="flex justify-between font-semibold p-4 border-t border-gray-200 dark:border-gray-600">
                            <span class="font-semibold text-lg">Total :</span>
                            <span class="font-semibold">${{ number_format($total, 2) }}</span>
                        </li>
                    </ul>

                </div>
            </div><!--end col-->
        </div><!--end grid-->
    </div>

</section>
<!-- End -->
@endsection