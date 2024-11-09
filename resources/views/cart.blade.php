@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<section class="relative md:py-24 py-16">
    <div class="container">
        <div class="grid lg:grid-cols-1">
            <div class="relative overflow-x-auto shadow dark:shadow-gray-800 rounded-md">
                <table class="w-full text-start">
                    <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                        <tr>
                            <th scope="col" class="p-4 w-4"></th>
                            <th scope="col" class="text-start p-4 min-w-[220px]">Tên sản phẩm</th>
                            <th scope="col" class="p-4 w-24 min-w-[100px]">Giá</th>
                            <th scope="col" class="p-4 w-56 min-w-[220px]">Số lượng</th>
                            <th scope="col" class="p-4 w-24 min-w-120">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cartItems->isEmpty())
                            <tr class="bg-white dark:bg-slate-900">
                                <td colspan="5" class="p-4 text-center text-slate-400">Giỏ hàng trống.</td>
                            </tr>
                        @else
                            @foreach ($cartItems as $item)
                                <tr class="bg-white dark:bg-slate-900">
                                    <td class="p-4">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">
                                                <i class="mdi mdi-window-close"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="p-4">
                                        <span class="flex items-center">
                                            <img src="{{ asset( 'storage/' .$item->variant->image) }}"
                                                class="rounded shadow dark:shadow-gray-800 w-12" alt="{{ $item->name }}" />
                                            <span class="ms-3">
                                                <span class="block font-semibold">{{ $item->product->name }} -
                                                    {{ $item->variant->color }} - {{ $item->variant->size }}</span>

                                                @if ($item->variant->stock == 0)
                                                    <span class="text-red-500 text-sm">
                                                        <br>Sản phẩm này đã hết hàng.
                                                    </span>
                                                @elseif ($item->variant->stock < $item->quantity)
                                                    <span class="text-red-500 text-sm">
                                                        <br>Sản phẩm chỉ còn {{ $item->variant->stock }} sản phẩm.
                                                    </span>
                                                @endif

                                            </span>
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">${{ number_format($item->variant->price, 2) }}</td>
                                    <td class="p-4 text-center">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="qty-icons flex">
                                                <input min="0" name="quantity" value="{{ $item->quantity }}" type="number"
                                                    class="quantity w-1/2" max="{{ $item->variant->stock ?? 0 }}" />
                                                <button type="submit" class="ml-2 text-indigo-600">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="p-4 text-end">${{ number_format($item->variant->price * $item->quantity, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 mt-6 gap-6">
                @if($cartItems->isEmpty()) <!-- Kiểm tra nếu giỏ hàng trống -->
                    <p class="text-center text-gray-500 py-4">Giỏ hàng của bạn hiện tại trống. Vui lòng thêm sản phẩm vào
                        giỏ hàng.</p>
                @else
                    <div class="lg:col-span-9 md:order-1 order-3">
                        <a href="{{ route('checkout') }}"
                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md me-2 mt-2">Thanh Toán</a>
                    </div>

                    <div class="lg:col-span-3 md:order-2 order-1">

                        <ul class="list-none shadow dark:shadow-gray-800 rounded-md">
                            <li class="flex justify-between p-4">
                                <span class="font-semibold text-lg">Giá :</span>
                                <span class="text-slate-400">${{ number_format($subtotal, 2) }}</span>
                            </li>
                            <li class="flex justify-between p-4 border-t border-gray-100 dark:border-gray-800">
                                <span class="font-semibold text-lg">Phụ thu :</span>
                                <span class="text-slate-400">${{ number_format($taxes, 2) }}</span>
                            </li>
                            <li
                                class="flex justify-between font-semibold p-4 border-t border-gray-200 dark:border-gray-600">
                                <span class="font-semibold text-lg">Tổng cộng :</span>
                                <span class="font-semibold">${{ number_format($total, 2) }}</span>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
@endsection