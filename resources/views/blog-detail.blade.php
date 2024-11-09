@extends('layouts.app')

@section('title', 'blog-detail')

@section('content')

<!-- Start Hero -->
<section class="relative table w-full py-32 lg:py-36 bg-[url('{{$blog->image }}')] bg-center bg-no-repeat bg-cover">
    <div class="absolute inset-0 bg-black opacity-80"></div>
    <div class="container relative">
        <div class="grid grid-cols-1 pb-8 text-center mt-10">
            <h3 class="mb-3 text-3xl leading-normal font-medium text-white">{{ $blog->title }}</h3>

            <ul class="list-none mt-6">
                <li class="inline-block font-semibold text-white/50 mx-5"> <span class="text-white block">Client :</span> <span class="block">Calvin Carlo</span></li>
                <li class="inline-block font-semibold text-white/50 mx-5"> <span class="text-white block">Date :</span> <span class="block">{{ $blog->created_at->format('d M, Y') }}</span></li>
                <li class="inline-block font-semibold text-white/50 mx-5"> <span class="text-white block">Time :</span> <span class="block">8 Min Read</span></li>
            </ul>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="absolute text-center z-10 bottom-5 start-0 end-0 mx-3">
        <ul class="tracking-[0.5px] mb-0 inline-block">
            <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-white"><a href="{{ route('home') }}">Techwind</a></li>
            <li class="inline-block text-base text-white/50 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="uil uil-angle-right-b"></i></li>
            <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out text-white" aria-current="page">Blogs</li>
        </ul>
    </div>
</section><!--end section-->

<div class="relative">
    <div class="shape absolute sm:-bottom-px -bottom-[2px] start-0 end-0 overflow-hidden z-1 text-white dark:text-slate-900">
        <svg class="w-full h-auto scale-[2.0] origin-top" viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
<!-- End Hero -->

<!-- Start Section-->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
            <div class="lg:col-span-8 md:col-span-6">
                <div class="p-6 rounded-md shadow dark:shadow-gray-800">

                    <img src="{{ $blog->image }}" class="rounded-md" alt="">

                    <div class="mt-6">
                        <p class="text-slate-400">{{ $blog->description }}</p>
                        <p class="text-slate-400 italic border-x-4 border-indigo-600 rounded-ss-xl rounded-ee-xl mt-3 p-3">" {{ $blog->description }} "</p>
                        <p class="text-slate-400 mt-3">{{ $blog->description }}</p>
                    </div>
                </div>

                <div class="p-6 rounded-md shadow dark:shadow-gray-800 mt-8">
                    <h5 class="text-lg font-semibold">Comments:</h5>

                    <div class="mt-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="assets/images/client/01.jpg" class="size-11 rounded-full shadow" alt="">

                                <div class="ms-3 flex-1">
                                    <a href="#" class="text-lg font-semibold hover:text-indigo-600 duration-500">Calvin Carlo</a>
                                    <p class="text-sm text-slate-400">6th May 2022 at 01:25 pm</p>
                                </div>
                            </div>

                            <a href="#" class="text-slate-400 hover:text-indigo-600 duration-500 ms-5"><i class="mdi mdi-reply"></i> Reply</a>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-slate-800 rounded-md shadow dark:shadow-gray-800 mt-6">
                            <p class="text-slate-400 italic">" There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour "</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="assets/images/client/02.jpg" class="size-11 rounded-full shadow" alt="">

                                <div class="ms-3 flex-1">
                                    <a href="#" class="text-lg font-semibold hover:text-indigo-600 duration-500">Calvin Carlo</a>
                                    <p class="text-sm text-slate-400">6th May 2022 at 01:25 pm</p>
                                </div>
                            </div>

                            <a href="#" class="text-slate-400 hover:text-indigo-600 duration-500 ms-5"><i class="mdi mdi-reply"></i> Reply</a>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-slate-800 rounded-md shadow dark:shadow-gray-800 mt-6">
                            <p class="text-slate-400 italic">" There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour "</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="assets/images/client/03.jpg" class="size-11 rounded-full shadow" alt="">

                                <div class="ms-3 flex-1">
                                    <a href="#" class="text-lg font-semibold hover:text-indigo-600 duration-500">Calvin Carlo</a>
                                    <p class="text-sm text-slate-400">6th May 2022 at 01:25 pm</p>
                                </div>
                            </div>

                            <a href="#" class="text-slate-400 hover:text-indigo-600 duration-500 ms-5"><i class="mdi mdi-reply"></i> Reply</a>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-slate-800 rounded-md shadow dark:shadow-gray-800 mt-6">
                            <p class="text-slate-400 italic">" There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour "</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="assets/images/client/04.jpg" class="size-11 rounded-full shadow" alt="">

                                <div class="ms-3 flex-1">
                                    <a href="#" class="text-lg font-semibold hover:text-indigo-600 duration-500">Calvin Carlo</a>
                                    <p class="text-sm text-slate-400">6th May 2022 at 01:25 pm</p>
                                </div>
                            </div>

                            <a href="#" class="text-slate-400 hover:text-indigo-600 duration-500 ms-5"><i class="mdi mdi-reply"></i> Reply</a>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-slate-800 rounded-md shadow dark:shadow-gray-800 mt-6">
                            <p class="text-slate-400 italic">" There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour "</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-md shadow dark:shadow-gray-800 mt-8">
                    <h5 class="text-lg font-semibold">Leave A Comment:</h5>

                    <form class="mt-8">
                        <div class="grid lg:grid-cols-12 lg:gap-6">
                            <div class="lg:col-span-6 mb-5">
                                <div class="text-start">
                                    <label for="name" class="font-semibold">Your Name:</label>
                                    <div class="form-icon relative mt-2">
                                        <i data-feather="user" class="size-4 absolute top-3 start-4"></i>
                                        <input name="name" id="name" type="text" class="form-input ps-11 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0" placeholder="Name :">
                                    </div>
                                </div>
                            </div>

                            <div class="lg:col-span-6 mb-5">
                                <div class="text-start">
                                    <label for="email" class="font-semibold">Your Email:</label>
                                    <div class="form-icon relative mt-2">
                                        <i data-feather="mail" class="size-4 absolute top-3 start-4"></i>
                                        <input name="email" id="email" type="email" class="form-input ps-11 w-full py-2 px-3 h-10 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0" placeholder="Email :">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="mb-5">
                                <div class="text-start">
                                    <label for="comments" class="font-semibold">Your Comment:</label>
                                    <div class="form-icon relative mt-2">
                                        <i data-feather="message-circle" class="size-4 absolute top-3 start-4"></i>
                                        <textarea name="comments" id="comments" class="form-input ps-11 w-full py-2 px-3 h-28 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-200 focus:border-indigo-600 dark:border-gray-800 dark:focus:border-indigo-600 focus:ring-0" placeholder="Message :"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit" name="send" class="py-2 px-5 inline-block tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md w-full">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-6">
                <div class="sticky top-20">
                    <h5 class="text-lg font-semibold bg-gray-50 dark:bg-slate-800 shadow dark:shadow-gray-800 rounded-md p-2 text-center">Author</h5>
                    <div class="text-center mt-8">
                        <img src="assets/images/client/05.jpg" class="size-24 mx-auto rounded-full shadow mb-4" alt="">

                        <a href="#" class="text-lg font-semibold hover:text-indigo-600 duration-500">Cristina Romsey</a>
                        <p class="text-slate-400">Content Writer</p>
                    </div>

                    <h5 class="text-lg font-semibold bg-gray-50 dark:bg-slate-800 shadow dark:shadow-gray-800 rounded-md p-2 text-center mt-8">Recent post</h5>
                    <div class="flex items-center mt-8">
                        <img src="assets/images/blog/06.jpg" class="h-16 rounded-md shadow dark:shadow-gray-800" alt="">

                        <div class="ms-3">
                            <a href="#" class="font-semibold hover:text-indigo-600">Consultant Business</a>
                            <p class="text-sm text-slate-400">1st May 2022</p>
                        </div>
                    </div>

                    <div class="flex items-center mt-4">
                        <img src="assets/images/blog/07.jpg" class="h-16 rounded-md shadow dark:shadow-gray-800" alt="">

                        <div class="ms-3">
                            <a href="#" class="font-semibold hover:text-indigo-600">Grow Your Business</a>
                            <p class="text-sm text-slate-400">1st May 2022</p>
                        </div>
                    </div>

                    <div class="flex items-center mt-4">
                        <img src="assets/images/blog/08.jpg" class="h-16 rounded-md shadow dark:shadow-gray-800" alt="">

                        <div class="ms-3">
                            <a href="#" class="font-semibold hover:text-indigo-600">Look On The Glorious Balance</a>
                            <p class="text-sm text-slate-400">1st May 2022</p>
                        </div>
                    </div>

                    <h5 class="text-lg font-semibold bg-gray-50 dark:bg-slate-800 shadow dark:shadow-gray-800 rounded-md p-2 text-center mt-8">Social sites</h5>
                    <ul class="list-none text-center mt-8">
                        <li class="inline"><a href="#" class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-indigo-600 hover:text-white hover:bg-indigo-600"><i data-feather="facebook" class="size-4"></i></a></li>
                        <li class="inline"><a href="#" class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-indigo-600 hover:text-white hover:bg-indigo-600"><i data-feather="instagram" class="size-4"></i></a></li>
                        <li class="inline"><a href="#" class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-indigo-600 hover:text-white hover:bg-indigo-600"><i data-feather="twitter" class="size-4"></i></a></li>
                        <li class="inline"><a href="#" class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-indigo-600 hover:text-white hover:bg-indigo-600"><i data-feather="linkedin" class="size-4"></i></a></li>
                        <li class="inline"><a href="#" class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-indigo-600 hover:text-white hover:bg-indigo-600"><i data-feather="github" class="size-4"></i></a></li>
                        <li class="inline"><a href="#" class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-indigo-600 hover:text-white hover:bg-indigo-600"><i data-feather="youtube" class="size-4"></i></a></li>
                        <li class="inline"><a href="#" class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-100 dark:border-gray-800 rounded-md text-slate-400 hover:border-indigo-600 hover:text-white hover:bg-indigo-600"><i data-feather="gitlab" class="size-4"></i></a></li>
                    </ul><!--end icon-->

                    <h5 class="text-lg font-semibold bg-gray-50 dark:bg-slate-800 shadow dark:shadow-gray-800 rounded-md p-2 text-center mt-8">Tagscloud</h5>
                    <ul class="list-none text-center mt-8">
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Business</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Finance</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Marketing</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Fashion</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Bride</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Lifestyle</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Travel</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Beauty</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Video</a></li>
                        <li class="inline-block m-2"><a href="#" class="px-3 py-1 text-slate-400 hover:text-white dark:hover:text-white bg-gray-50 dark:bg-slate-800 text-sm hover:bg-indigo-600 dark:hover:bg-indigo-600 rounded-md shadow dark:shadow-gray-800 duration-500">Audio</a></li>
                    </ul>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="md:flex justify-center">
            <div class="lg:w-2/3 text-center">
                <h3 class="md:text-3xl text-2xl md:leading-normal leading-normal font-semibold mb-6">Subscribe our weekly subscription</h3>

                <p class="text-slate-400 max-w-xl mx-auto">Add some text to explain benefits of subscripton on your services. We'll send you the best of our blog just once a weekly.</p>

                <div class="mt-8">
                    <div class="text-center subcribe-form">
                        <form class="relative mx-auto max-w-xl">
                            <input type="email" id="subemail" name="name" class="py-4 pe-40 ps-6 w-full h-[50px] outline-none text-black dark:text-white rounded-full bg-white/70 dark:bg-slate-900/70 border border-gray-100 dark:border-gray-700" placeholder="Enter your email id..">
                            <button type="submit" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center absolute top-[2px] end-[3px] h-[46px] bg-indigo-600 hover:bg-indigo-700 border border-indigo-600 hover:border-indigo-700 text-white rounded-full">Subcribe Now</button>
                        </form><!--end form-->
                    </div>
                </div>
            </div>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

@endsection