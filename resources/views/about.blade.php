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
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia deserunt mollit anim id est laborum. Sed ut perspiciatis
                    unde omnis iste natus error sit voluptatem accusantium doloremque
                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                    veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit
                    aut fugit, sed quia consequuntur magni dolores eos qui ratione
                    voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem
                    ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia
                    non numquam eius modi tempora incidunt ut labore et dolore magnam
                    aliquam quaerat voluptatem.
                </p>
            </div>
        </div>
    </div>
    <!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="grid grid-cols-1 pb-8 text-center">
            <h3
                class="mb-6 md:text-3xl text-2xl md:leading-normal leading-normal font-semibold">
                Features
            </h3>

            <p class="text-slate-400 max-w-xl mx-auto">
                Start working with Tailwind CSS that can provide everything you need
                to generate awareness, drive traffic, connect.
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
                        class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">Free Shipping</a>
                    <p class="text-slate-400 duration-500 mt-3">
                        If the distribution of letters and 'words' is random, the reader
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
                        <i class="uil uil-user-arrows"></i>
                    </div>
                </div>

                <div class="mt-6">
                    <a
                        href="#"
                        class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">24/7 Support</a>
                    <p class="text-slate-400 duration-500 mt-3">
                        If the distribution of letters and 'words' is random, the reader
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
                        class="text-xl font-medium hover:text-indigo-600 duration-500 ease-in-out">Payment Process</a>
                    <p class="text-slate-400 duration-500 mt-3">
                        If the distribution of letters and 'words' is random, the reader
                        will not be distracted from making.
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

            <div class="lg:col-span-7 md:col-span-6">
                <span
                    class="bg-indigo-600/5 text-indigo-600 text-xs font-bold px-2.5 py-0.5 rounded h-5">Mobile Apps</span>
                <h4
                    class="md:text-3xl text-2xl lg:leading-normal leading-normal font-medium my-4">
                    Available for your <br />
                    Smartphones
                </h4>
                <p class="text-slate-400 max-w-xl mb-0">
                    Search all the open positions on the web. Get your own
                    personalized salary estimate. Read reviews on over 30000+
                    companies worldwide.
                </p>
                <div class="my-5">
                    <a href="#"><img
                            src="assets/images/app/app.png"
                            class="m-1 inline-block"
                            alt="" /></a>

                    <a href="#"><img
                            src="assets/images/app/playstore.png"
                            class="m-1 inline-block"
                            alt="" /></a>
                </div>

                <div class="inline-block">
                    <div
                        class="pt-4 flex items-center border-t border-gray-100 dark:border-gray-700">
                        <i
                            data-feather="smartphone"
                            class="me-2 text-indigo-600 size-10"></i>
                        <div class="content">
                            <h6 class="text-base font-medium">
                                Install app now on your cellphones
                            </h6>
                            <a
                                href="#"
                                class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:duration-500 text-indigo-600 hover:text-indigo-600 after:bg-indigo-600 duration-500 ease-in-out">Learn More <i class="uil uil-angle-right-b"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end gird-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- End -->

@endsection