@extends('layouts.app')

@section('title', 'about')

@section('content')


<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1 text-center mt-14">
            <h3 class="text-3xl leading-normal font-semibold">About Us</h3>
        </div><!--end grid-->

        <div class="relative text-center mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-indigo-600"><a href="{{ route('home') }}">Techwind</a></li>
                <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="uil uil-angle-right-b"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-indigo-600" aria-current="page">About us</li>
            </ul>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container">
        <div class="md:flex justify-center">
            <div class="lg:w-3/5 text-center">
                <h5 class="text-2xl font-semibold">Techwind Shop</h5>

                <p class="text-slate-400 mt-4">
                Chào mừng bạn đến với TechWind - nơi cung cấp những sản phẩm công nghệ tiên tiến và chất lượng hàng đầu! Tại TechWind, chúng tôi luôn cam kết mang đến cho khách hàng những trải nghiệm mua sắm tuyệt vời với các sản phẩm điện tử, phụ kiện công nghệ, và thiết bị thông minh mới nhất, chính hãng, từ những thương hiệu uy tín.

Tầm nhìn của chúng tôi là trở thành điểm đến hàng đầu cho những tín đồ yêu thích công nghệ. Với mục tiêu không ngừng đổi mới và phát triển, TechWind không chỉ cung cấp các sản phẩm chất lượng mà còn mang đến những dịch vụ tiện ích để hỗ trợ khách hàng một cách tốt nhất.
                </p>
            </div>
        </div>
    </div>
    <!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h3
                class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">
                Tại sao chọn TechWind?
            </h3>

            <p class="text-slate-400 max-w-xl mx-auto">
           

                Giá cả hợp lý: Chúng tôi luôn cung cấp các sản phẩm với mức giá cạnh tranh, đi kèm với các chương trình khuyến mãi hấp dẫn.
                Đảm bảo chất lượng: Các sản phẩm tại TechWind được bảo hành chính hãng, đảm bảo bạn sẽ nhận được hỗ trợ khi có sự cố xảy ra.
                Dễ dàng mua sắm trực tuyến: Với giao diện thân thiện và dễ sử dụng, bạn có thể dễ dàng tìm kiếm và đặt mua các sản phẩm yêu thích từ bất kỳ đâu.
                Cảm ơn bạn đã lựa chọn TechWind! Chúng tôi hy vọng sẽ đồng hành cùng bạn trên hành trình khám phá những sản phẩm công nghệ tuyệt vời.
            </p>
        </div>
        <!--end grid-->

        <div
            class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 mt-4 gap-[30px]">
            <!-- Content -->
            <div
                class="group relative lg:px-6 mt-4 duration-500 rounded-xl overflow-hidden text-center">
                <div class="relative overflow-hidden text-transparent -m-3">
                    <i
                        data-feather="hexagon"
                        class="size-28 fill-indigo-600/5 mx-auto rotate-[30deg]"></i>
                    <div
                        class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-indigo-600 rounded-xl duration-500 text-3xl flex align-middle justify-center items-center">
                        <i class="uil uil-rocket"></i>
                    </div>
                </div>

                <div class="mt-6">
                    <a
                        href="#"
                        class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">Miễn Phí Giao Hàng</a>
                    <p class="text-slate-400 duration-500 mt-3">
                      Để mang lại sự thuận tiện tối đa cho khách hàng, TechWind cung cấp dịch vụ giao hàng miễn phí cho tất cả đơn hàng trên toàn quốc.
                    </p>
                </div>
            </div>
            <!-- Content -->

            <!-- Content -->
            <div
                class="group relative lg:px-6 mt-4 duration-500 rounded-xl overflow-hidden text-center">
                <div class="relative overflow-hidden text-transparent -m-3">
                    <i
                        data-feather="hexagon"
                        class="size-28 fill-indigo-600/5 mx-auto rotate-[30deg]"></i>
                    <div
                        class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-indigo-600 rounded-xl duration-500 text-3xl flex align-middle justify-center items-center">
                        <i class="uil uil-user-arrows"></i>
                    </div>
                </div>

                <div class="mt-6">
                    <a
                        href="#"
                        class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">Hỗ Trợ 24/7 </a>
                    <p class="text-slate-400 duration-500 mt-3">
                    Cảm ơn bạn đã lựa chọn TechWind! Chúng tôi hy vọng sẽ đồng hành cùng bạn trên hành trình khám phá những sản phẩm công nghệ tuyệt vời và luôn sẵn sàng hỗ trợ bạn 24/7.ords' is random, the reader
                        will not be distracted from making.
                    </p>
                </div>
            </div>
            <!-- Content -->

            <!-- Content -->
            <div
                class="group relative lg:px-6 mt-4 duration-500 rounded-xl overflow-hidden text-center">
                <div class="relative overflow-hidden text-transparent -m-3">
                    <i
                        data-feather="hexagon"
                        class="size-28 fill-indigo-600/5 mx-auto rotate-[30deg]"></i>
                    <div
                        class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-indigo-600 rounded-xl duration-500 text-3xl flex align-middle justify-center items-center">
                        <i class="uil uil-transaction"></i>
                    </div>
                </div>

                <div class="mt-6">
                    <a
                        href="#"
                        class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">Quy trình thanh toán</a>
                    <p class="text-slate-400 duration-500 mt-3">
                    Nếu bạn chọn phương thức thanh toán khi nhận hàng, người giao hàng sẽ thu tiền mặt khi giao sản phẩm tại địa chỉ mà bạn đã cung cấp.
                    </p>
                </div>
            </div>
            <!-- Content -->
        </div>
        <!--end grid-->
    </div>
    <!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div id="grid" class="md:flex w-full justify-center mx-auto mt-4">
            <div class="md:w-1/2 p-3 picture-item">
                <div
                    class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img
                        src="assets/images/shop/hoodie.jpg"
                        class="group-hover:scale-110 duration-500"
                        alt="" />
                    <div class="absolute bottom-4 start-4">
                        <a
                            href="#"
                            class="text-xl font-semibold hover:text-indigo-600 duration-500">Hoodies</a>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 p-3 picture-item">
                <div
                    class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img
                        src="assets/images/shop/beanie.jpg"
                        class="group-hover:scale-110 duration-500"
                        alt="" />
                    <div class="absolute bottom-4 start-4">
                        <a
                            href="#"
                            class="text-xl font-semibold hover:text-indigo-600 duration-500">Beanies for Man & Women</a>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 p-3 picture-item">
                <div
                    class="group relative overflow-hidden rounded-md shadow dark:shadow-gray-800">
                    <img
                        src="assets/images/shop/glasses.jpg"
                        class="group-hover:scale-110 duration-500"
                        alt="" />
                    <div class="absolute bottom-4 start-4">
                        <a
                            href="#"
                            class="text-xl font-semibold hover:text-indigo-600 duration-500">Glasses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container relative md:mt-24 mt-16">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center">
            <div class="lg:col-span-5 md:col-span-6">
                <img
                    src="assets/images/illustrator/envelope.svg"
                    class="mx-auto d-block"
                    alt="" />
            </div>

            
        </div>
        <!--end gird-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- End -->

@endsection