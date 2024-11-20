@extends('layouts.app')

@section('title', $category ? $category->name : 'Category Page')

@section('content')
<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold"> Lọc sản phẩm</h3>
        </div>
        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                    <a href="index-shop.html">Techwind</a>
                </li>
                </li>
                <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">

                </li>
            </ul>
        </div>
    </div>
</section>
<!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16 px-5">
    <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
        <!-- Sidebar -->
        <div class="lg:col-span-3 md:col-span-4 sm:col-span-12">
            <div class="shadow dark:shadow-gray-800 p-6 rounded-md bg-white dark:bg-slate-900 sticky top-20">
                <form action="{{ route('shop.index') }}" method="GET">
                    <!-- Lọc theo từ khóa -->
                    <div>
                        <label for="searchname" class="hidden font-semibold">Search</label>
                        <div class="relative">
                            <i data-feather="search" class="size-4 absolute top-3 start-3"></i>
                            <input name="search" id="searchname" type="text"
                                class="form-input w-full py-2 px-3 h-10 ps-9 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                placeholder="Search" value="{{ request()->input('search') }}" />
                        </div>
                    </div>

                    <!-- Lọc theo danh mục -->
                    <div class="mt-4">
                        <label class="font-semibold">Categories</label>
                        <div class="block mt-2">

                            <!-- Lặp qua các danh mục cha và con -->
                            @foreach($categories as $cat)
                            @if ($cat->parent_id == null) <!-- Chỉ hiển thị danh mục cha -->
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox"
                                        class="form-checkbox border-gray-200 dark:border-gray-800 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                        name="category_id[]" value="{{ $cat->id }}"
                                        {{ in_array($cat->id, (array) request('category_id', [])) ? 'checked' : '' }} />
                                    <span class="text-slate-400">{{ $cat->name }}</span>
                                </label>
                                <!-- Hiển thị danh mục con dưới danh mục cha này -->
                                <div class="ms-4">
                                    @foreach($categories as $subCat)
                                    @if ($subCat->parent_id == $cat->id) <!-- Kiểm tra danh mục con -->
                                    <label class="inline-flex items-center">
                                        <input type="checkbox"
                                            class="form-checkbox border-gray-200 dark:border-gray-800 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 me-2"
                                            name="category_id[]" value="{{ $subCat->id }}"
                                            {{ in_array($subCat->id, (array) request('category_id', [])) ? 'checked' : '' }} />
                                        <span class="text-slate-400">{{ $subCat->name }}</span>
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="mt-2">
                        <input type="submit"
                            class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full"
                            value="Apply Filter" />
                    </div>
                </form>
            </div>
        </div>


        <!--end col-->

        <!-- Product Grid -->
        <div class="lg:col-span-9 md:col-span-8 sm:col-span-12">
            <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                <div class="lg:col-span-9 md:col-span-8">
                    <h3 class="text-xl leading-normal font-semibold">
                        Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }}
                        results
                    </h3>
                </div>


            </div>

            <!--end grid-->

            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-8 gap-[30px] bg-gray-200 p-3 rounded-xl  ">
                @foreach($products as $product)
                <div class="group transform lg:scale-105 border-2 rounded-xl bg-white p-1">
                    <div
                        class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                        @if ($product->variants->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->variants[0]->image) }}" alt="{{ $product->name }}"
                            class="w-full h-auto" />
                        @else
                          <img src="{{ asset('images/default-thumbnail.jpg') }}" alt="{{ $product->name }}"/>
                        @endif

                        <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                                @csrf
                                @if ($product->variants->isNotEmpty())
                                <div class="mt-4">
                                    <select name="variant_id" id="variant"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500">
                                        @foreach ($product->variants as $variant)
                                        <option value="{{ $variant->id }}" class="variant-option">
                                            {{ $variant->color }} - ${{ number_format($variant->price, 2) }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>
                                @endif
                                @if(auth()->check())
                                <button type="submit" data-product-id="{{ $product->id }}"
                                    class="add-to-cart mt-2 py-2 px-5 inline-block font-semibold tracking-wide border border-transparent duration-500 text-base text-center bg-slate-900 hover:bg-slate-700 text-white w-full rounded-md shadow-md hover:shadow-lg transition">
                                    Add to Cart
                                </button>
                                @endif
                            </form>
                        </div>

                        <ul class="list-none absolute top-[10px] end-4 opacity-0 group-hover:opacity-100 duration-500">
                            <li>
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                    class="inline-flex items-center">
                                    @csrf
                                    <button type="submit"
                                        class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"
                                        aria-label="Add to wishlist">
                                        <i class="mdi mdi-heart"></i>
                                    </button>
                                </form>
                            </li>

                            <li class="mt-1">
                                <a href="{{ route('product.show', $product->id) }}"
                                    class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"
                                    aria-label="View product details">
                                    <i class="mdi mdi-eye-outline"></i>
                                </a>
                            </li>

                        </ul>

                        @if($product->is_new)
                        <ul class="list-none absolute top-[10px] start-4">
                            <li>
                                <a href="javascript:void(0)"
                                    class="bg-orange-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">New</a>
                            </li>
                        </ul>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('product.show', $product->id) }}"
                            class="hover:text-indigo-600 text-lg font-semibold">{{ $product->name }}</a>
                        <div class="flex justify-between items-center mt-1">
                            @if ($product->variants->isNotEmpty())
                            <p class="text-green-600">${{ number_format($product->variants[0]->price, 2) }}</p>
                            @else
                            <p class="text-red-600">Price not available</p>
                            @endif
                            <!-- Hiển thị phần đánh giá sao -->
                            <div class="product-rating mt-2">
                                <ul class="list-none inline-block text-orange-400">
                                    <!-- Hiển thị các sao đã đánh giá -->
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li class="inline">
                                        <i
                                            class="mdi mdi-star {{ $i <= $product->averageRating ? 'text-yellow-500' : 'text-slate-400' }}"></i>
                                        </li>
                                        @endfor
                                </ul>

                            </div>
                        </div>
                        <div class="bg-gray-100 rounded-xl p-1">
                            <div class="flex ">
                                <div class="flex-1 text-left text-xs">
                                    <!-- Cột bên trái -->
                                    <span>CPU: A18</span><br>
                                    <span>RAM: 8G</span><br>
                                    <span>Bộ Nhớ: 256G</span><br>
                                </div>

                                <div class="flex-1 text-right text-xs">
                                    <!-- Cột bên phải -->
                                    <span>Tỉ lệ: 6.9"</span><br>
                                    <span>Tần số quét: 120z"</span>
                                </div>
                            </div>
                        </div>
                        <div>

                            <p class="p-1"><label class="bg-red-500 rounded-sm p-1  ">KM</label> Trả góp 0% - Không phí</p>
                            <p class="p-1"><label class="bg-red-500 rounded-sm p-1 ">KM</label> Ưu Đãi cho HSSV,Thầy cô</p>
                        </div>
                        <ul class="border-2 rounded-xl text-center">
                            <li>
                                <a href="{{ route('product.show', $product->id) }}">Xem thêm</a>
                            </li>
                        </ul>


                    </div>
                </div>
                @endforeach
            </div>
            <!--end grid-->

            <!-- Pagination -->
            <div class="grid md:grid-cols-12 grid-cols-1 mt-8">
                <div class="md:col-span-12 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="inline-flex items-center -space-x-px">
                            {{-- Previous Page Link --}}
                            <li>
                                @if ($products->onFirstPage())
                                <span
                                    class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-lg">
                                    <i class="uil uil-angle-left text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </span>
                                @else
                                <a href="{{ $products->previousPageUrl() }}&category_id={{ request('category_id') }}&search={{ request('search') }}"
                                    class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-lg hover:text-white border border-gray-100 dark:border-gray-700 hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600">
                                    <i class="uil uil-angle-left text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </a>
                                @endif
                            </li>

                            {{-- Pagination Links --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <li>
                                @if ($page == $products->currentPage())
                                <a aria-current="page"
                                    class="z-10 size-[40px] inline-flex justify-center items-center text-white bg-indigo-600 border border-indigo-600">{{ $page }}</a>
                                @else
                                <a href="{{ $url }}&category_id={{ request('category_id') }}&search={{ request('search') }}"
                                    class="size-[40px] inline-flex justify-center items-center text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-700 hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600">{{ $page }}</a>
                                @endif
                            </li>
                            @endforeach

                            {{-- Next Page Link --}}
                            <li>
                                @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}&category_id={{ request('category_id') }}&search={{ request('search') }}"
                                    class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-lg hover:text-white border border-gray-100 dark:border-gray-700 hover:border-indigo-600 dark:hover:border-indigo-600 hover:bg-indigo-600 dark:hover:bg-indigo-600">
                                    <i class="uil uil-angle-right text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </a>
                                @else
                                <span
                                    class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-lg">
                                    <i class="uil uil-angle-right text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </span>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end section-->
@endsection