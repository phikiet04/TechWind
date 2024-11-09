@extends('layouts.app')

@section('title', $product->name)

@section('content')
<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold">
                {{$product->category->name}} / {{$product->name}}

            </h3>
        </div>
        <!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600">
                    <a href="index-shop.html">Techwind</a>
                </li>
                <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180">
                    <i class="uil uil-angle-right-b"></i>
                </li>
                <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">
                    {{$product->name}}
                </li>
            </ul>
        </div>
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container">
        <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] items-center">
            <div class="lg:col-span-5 md:col-span-6">
                <div class="tiny-single-item">
                    @foreach ($product->variants as $variant)
                        <div class="tiny-slide">
                            @if ($variant->image)
                                <img src="{{ asset('storage/' . $variant->image) }}"
                                    class="rounded-md shadow dark:shadow-gray-800"
                                    alt="{{ $product->name }} - {{ $variant->name }}" />
                            @else
                                <img src="{{ asset('images/default-product.jpg') }}"
                                    class="rounded-md shadow dark:shadow-gray-800" alt="Default Product Image" />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-7 md:col-span-6">
                <div class="lg:ms-6">
                    <h5 class="text-2xl font-semibold">{{ $product->name }}</h5>
                    <div class="product-rating">
                        <ul class="list-none inline-block text-orange-400">
                            @for ($i = 1; $i <= 5; $i++)
                                <li class="inline">
                                    <i
                                        class="mdi mdi-star {{ $i <= $averageRating ? 'text-yellow-500' : 'text-slate-400' }}"></i>
                                </li>
                            @endfor
                        </ul>
                        <ul class="list-none inline-block text-slate-400">
                            <li class="inline text-slate-400 font-semibold">
                                {{ number_format($averageRating, 1) }} ({{ $reviewCount }} reviews)
                            </li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-lg font-semibold">Mô tả :</h5>
                        <p class="text-slate-400 mt-2">{{ $product->description }}</p>

                        <ul class="list-none text-slate-400 mt-4">
                            <li class="mb-1 flex">
                                <i class="uil uil-check-circle text-indigo-600 text-xl me-2"></i>
                                Giải pháp Marketing số hiện đại, giúp bạn phát triển bền vững
                            </li>
                            <li class="mb-1 flex">
                                <i class="uil uil-check-circle text-indigo-600 text-xl me-2"></i>
                                Đội ngũ Marketing giàu kinh nghiệm, sáng tạo và nhiệt huyết
                            </li>
                            <li class="mb-1 flex">
                                <i class="uil uil-check-circle text-indigo-600 text-xl me-2"></i>
                                Tạo dấu ấn riêng cho thương hiệu với thiết kế độc đáo
                            </li>
                        </ul>
                    </div>
                    @if(auth()->check())
                        <div class="grid lg:grid-cols-2 grid-cols-1 gap-[30px] mt-4">
                            <!-- Size and Color Section -->
                            <div class="flex items-center">
                                <h5 class="text-lg font-semibold me-2 min-w-[220px]">Chọn sản phẩm:</h5>
                                <div class="w-full min-w-[220px]">
                                    <select name="variant_id" id="variant"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                                        required>
                                        <option class="" value="">Chọn size và màu</option>
                                        @foreach ($product->variants as $variant)
                                            <option value="{{ $variant->id }}" data-price="{{ $variant->price }}"
                                                data-stock="{{ $variant->stock }}">
                                                {{ $variant->size }} - {{ $variant->color }} -
                                                ${{ number_format($variant->price, 2) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>



                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            <!-- Hidden Inputs for Variant ID and Quantity -->
                            <input type="hidden" name="variant_id" id="variant_id" value="">
                            <input type="hidden" name="quantity" id="quantity_input" value="1">

                            <div class="mt-4">
                                <button type="submit" data-product-id="{{ $product->id }}"
                                    class="add-to-cart py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center rounded-md bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white mt-2">
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="mt-4">Bạn cần <a href="{{ route('login') }}" class="text-red-600 underline">đăng nhập</a>
                            để thêm vào giỏ
                            hàng.</p>
                    @endif
                </div>
            </div>
        </div>

        <!--end grid-->

        <div class="grid md:grid-cols-12 grid-cols-1 mt-10 gap-[30px]">
            <div class="lg:col-span-3 md:col-span-5">
                <div class="sticky top-20">
                    <ul class="flex-column p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md"
                        id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li role="presentation">
                            <button
                                class="px-4 py-2 text-start text-base font-semibold rounded-md w-full hover:text-indigo-600 duration-500"
                                id="description-tab" data-tabs-target="#description" type="button" role="tab"
                                aria-controls="description" aria-selected="true">
                                Mô tả
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                id="addinfo-tab" data-tabs-target="#addinfo" type="button" role="tab"
                                aria-controls="addinfo" aria-selected="false">
                                Thông tin chi tiết
                            </button>
                        </li>
                        <li role="presentation">
                            <button
                                class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500"
                                id="review-tab" data-tabs-target="#review" type="button" role="tab"
                                aria-controls="review" aria-selected="false">
                                Review
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-9 md:col-span-7">
                <div id="myTabContent" class="p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md">
                    <div class="" id="description" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="text-slate-400">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div class="hidden" id="addinfo" role="tabpanel" aria-labelledby="addinfo-tab">
                        <table class="w-full text-start">
                            <tbody>
                                <tr class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-gray-700">
                                    <td class="font-semibold py-4" style="width: 100px">
                                        Color
                                    </td>
                                    <td class="text-slate-400 py-4">
                                        @foreach ($product->variants as $index => $variant)
                                            {{ $variant->color }} @if ($index < count($product->variants) - 1)
                                                -
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>

                                <tr class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-gray-700">
                                    <td class="font-semibold py-4">Giá</td>
                                    <td class="text-slate-400 py-4">
                                        @foreach ($product->variants as $index => $variant)
                                            ${{ $variant->price }} @if ($index < count($product->variants) - 1)
                                                -
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>

                                <tr class="bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-gray-700">
                                    <td class="font-semibold py-4">Size</td>
                                    <td class="text-slate-400 py-4">
                                        @foreach ($product->variants as $index => $variant)
                                            {{ $variant->size }} @if ($index < count($product->variants) - 1)
                                                -
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="hidden" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <!-- Hiển thị các bình luận (reviews) của sản phẩm -->
                        @if($reviews->isEmpty())
                            <p>No reviews yet.</p>
                        @else
                            @foreach($reviews as $review)
                                <div class="review-item mb-6 p-4 border-b border-gray-200">
                                    <div class="flex items-center mb-3">
                                        <!-- Ảnh đại diện người dùng -->
                                        <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('default-avatar.jpg') }}"
                                            class="w-12 h-12 rounded-full shadow" alt="">

                                        <div class="ms-3">
                                            <!-- Tên người dùng -->
                                            <p class="font-semibold">{{ $review->user->name }}</p>
                                            <!-- Thời gian đánh giá -->
                                            <p class="text-sm text-slate-400">
                                                {{ \Carbon\Carbon::parse($review->created_at)->format('jS F Y \a\t h:i A') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Đánh giá sao -->
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i
                                                class="mdi mdi-star{{ $i <= $review->rating ? '' : '-outline' }} text-yellow-500"></i>
                                        @endfor
                                    </div>

                                    <!-- Bình luận -->
                                    <p class="mt-3 text-gray-700">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        @endif

                        <!-- Form đánh giá chỉ hiển thị nếu người dùng đã đăng nhập -->
                        @if(Auth::check())
                            <form id="review-form" method="POST"
                                action="{{ route('review.store', ['product' => $product->id]) }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <!-- Đánh giá sao -->
                                <ul class="list-none inline-block text-orange-400">
                                    <li class="inline star" data-value="1"><i class="mdi mdi-star text-lg"></i></li>
                                    <li class="inline star" data-value="2"><i class="mdi mdi-star text-lg"></i></li>
                                    <li class="inline star" data-value="3"><i class="mdi mdi-star text-lg"></i></li>
                                    <li class="inline star" data-value="4"><i class="mdi mdi-star text-lg"></i></li>
                                    <li class="inline star" data-value="5"><i class="mdi mdi-star text-lg"></i></li>
                                </ul>

                                <ul class="list-none inline-block text-orange-400">
                                    <li class="inline text-slate-400 font-semibold" id="rating-value">0 (0)</li>
                                </ul>

                                <!-- Hidden input để lưu rating -->
                                <input type="hidden" id="rating" name="rating" value="0">

                                <div class="grid lg:grid-cols-12 lg:gap-6">
                                    <!-- Tên người dùng (điền sẵn từ tài khoản người dùng) -->
                                    <div class="lg:col-span-6 mb-5">
                                        <label for="name" class="font-semibold">Your Name:</label>
                                        <input name="name" id="name" type="text"
                                            class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            value="{{ Auth::user()->name }}" readonly />
                                    </div>

                                    <!-- Email người dùng (điền sẵn từ tài khoản người dùng) -->
                                    <div class="lg:col-span-6 mb-5">
                                        <label for="email" class="font-semibold">Your Email:</label>
                                        <input name="email" id="email" type="email"
                                            class="form-input w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                            value="{{ Auth::user()->email }}" readonly />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 mb-5">
                                    <label for="comments" class="font-semibold">Your Comment:</label>
                                    <textarea name="comment" id="comments"
                                        class="form-input w-full py-2 px-3 h-28 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0"
                                        placeholder="Message:"></textarea>
                                </div>

                                <button type="submit" id="submit"
                                    class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full">
                                    Submit Review
                                </button>
                            </form>
                        @else
                            <p>Please log in to submit a review.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <!--end grid-->
    </div>
    <!--end container-->
    <!-- Start Related Products -->
    <section class="related-products mt-10">
        <div class="container">
            <h3 class="text-2xl font-semibold mb-6">Sản phẩm cùng danh mục</h3>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
            @foreach($relatedProducts as $product)
                <div class="group transform lg:scale-105">
                    <div
                        class="relative overflow-hidden shadow dark:shadow-gray-800 group-hover:shadow-lg group-hover:dark:shadow-gray-800 rounded-md duration-500">
                        @if ($product->variants->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->variants[0]->image) }}" alt="{{ $product->name }}"
                                class=" max-h-300px object-cover" />
                        @else
                            <img src="{{ asset('images/default-thumbnail.jpg') }}" alt="{{ $product->name }}"
                                class=" max-h-300px object-cover" />
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
                            <div class="product-rating mt-2">
                                <ul class="list-none inline-block text-orange-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <li class="inline">
                                            <i
                                                class="mdi mdi-star {{ $i <= $product->averageRating ? 'text-yellow-500' : 'text-slate-400' }}"></i>
                                        </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reviewForm = document.getElementById('review-form');
            const ratingInput = document.getElementById('rating');
            const ratingValue = document.getElementById('rating-value');
            const stars = document.querySelectorAll('.star');

            // Xử lý sự kiện khi người dùng click vào sao để chọn đánh giá
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = this.getAttribute('data-value');
                    ratingInput.value = rating; // Lưu giá trị rating vào hidden input
                    ratingValue.textContent = `${rating} (0)`; // Hiển thị rating đã chọn
                });
            });

            // Xử lý form submit
            reviewForm.addEventListener('submit', function (event) {
                event.preventDefault(); // Ngừng việc gửi form theo cách mặc định

                const formData = new FormData(reviewForm);

                fetch('{{ route('review.store', ['product' => $product->id]) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Đảm bảo CSRF token có mặt
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            alert('Your review has been submitted!');
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting review:', error);
                        alert('There was an error submitting your review.');
                    });
            });
        });


    </script>
</section>
<!--end section-->
<!-- End -->
@endsection