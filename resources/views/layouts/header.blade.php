
<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
<!-- Mirrored from shreethemes.in/techwind/landing/index-shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Mar 2024 01:43:09 GMT -->

<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'TechWind')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/> 
    <meta name="description" content="Tailwind CSS Multipurpose Landing & Admin Dashboard Template" />
    <meta name="keywords"
        content="agency, application, business, clean, creative, cryptocurrency, it solutions, modern, multipurpose, nft marketplace, portfolio, saas, software, tailwind css" />
    <meta name="author" content="Shreethemes" />
    <meta name="website" content="https://shreethemes.in/" />
    <meta name="email" content="support@shreethemes.in" />
    <meta name="version" content="2.2.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Css -->
    <link href="{{ asset('assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet" />
    <!-- Main Css -->
    <link href="{{ asset('assets/libs/%40iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('assets/libs/%40mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
</head>

<body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900 bg-gray-100">
    <!-- Loader Start -->
    <!-- <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div> -->
    <!-- Loader End -->
     

    <!-- Start Navbar -->
    <nav id="topnav" class="defaultscroll is-sticky bg-gray-100 dark:bg-slate-900">
        <div class="container relative">
            <!-- Logo container-->
            <a class="logo" href="{{route('home')}}">
                <img src="assets/images/logo-dark.png" class="inline-block dark:hidden" alt="" />
                <img src="assets/images/logo-light.png" class="hidden dark:inline-block" alt="" />
            </a>

            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <!--Login button Start-->
            <ul class="buy-button list-none mb-0">
                <li class="dropdown inline-block relative me-1">
                    <button data-dropdown-toggle="dropdown" class="dropdown-toggle text-[20px]" type="button">
                        <i class="uil uil-search align-middle"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu absolute overflow-hidden end-0 m-0 mt-4 z-10 w-52 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                        onclick="event.stopPropagation();">
                        <div class="relative">
                            <i class="uil uil-search text-lg absolute top-[3px] end-3"></i>
                            <input type="text" class="form-input h-9 pe-10 sm:w-44 w-36 border-0 focus:ring-0" name="s"
                                id="searchItem" placeholder="Search..." />
                        </div>
                    </div>
                </li>

                <li class="dropdown inline-block relative">
                    <a href="{{route('cart')}}"
                        class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border border-indigo-600 hover:border-indigo-700 text-white"
                        type="button">
                        <i class="mdi mdi-cart"></i>
                    </a>


                </li>

                <li class="inline-block">
                    <a href="javascript:void(0)"
                        class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border border-indigo-600 hover:border-indigo-700 text-white"
                        onclick="WishList.showModal()">
                        <i class="mdi mdi-heart"></i>
                    </a>
                </li>

                <li class="dropdown inline-block relative">
                    <button data-dropdown-toggle="dropdown"
                        class="dropdown-toggle size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border border-indigo-600 hover:border-indigo-700 text-white"
                        type="button">
                        <i class="mdi mdi-account"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-44 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                        onclick="event.stopPropagation();">
                        <ul class="py-2 text-start" aria-labelledby="dropdownDefault">
                            @auth
                                <!-- Show these links if the user is logged in -->
                                <li>
                                    <a href="{{ route('users.show', Auth::user()->id) }}"
                                        class="block py-1.5 px-4 hover:text-indigo-600">
                                        <i class="uil uil-user align-middle me-1"></i> Account
                                    </a>
                                </li>

                                <li class="border-t border-gray-100 dark:border-gray-800 my-2"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="block py-1.5 px-4 hover:text-indigo-600">
                                            <i class="uil uil-sign-out-alt align-middle me-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @endauth

                            @guest
                                <!-- Show these links if the user is not logged in -->
                                <li>
                                    <a href="{{ route('login') }}" class="block py-1.5 px-4 hover:text-indigo-600">
                                        <i class="uil uil-sign-out-alt align-middle me-1"></i> Login
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}" class="block py-1.5 px-4 hover:text-indigo-600">
                                        <i class="uil uil-sign-out-alt align-middle me-1"></i> Register
                                    </a>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </li>
            </ul>
            <!--Login button End-->

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{ route('home') }}" class="sub-menu-item">Trang chủ</a></li>

                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)   ">Danh mục</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('shop.index', ['category_id' => $category->id]) }}"
                                        class="sub-menu-item">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('blog') }}" class="sub-menu-item">Blogs</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="sub-menu-item">About Us</a>
                    </li>

                    <li>
                        <a href="{{ route('contact')}}" class="sub-menu-item">Liên hệ</a>
                    </li>
                </ul>
                <!--end navigation menu-->
            </div>
            <!--end navigation-->
        </div>
        <!--end container-->
    </nav>
    <!--end header-->
    <!-- End Navbar -->

    <!-- Start Modal -->
    <dialog id="WishList"
        class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 text-slate-900 dark:text-white">
        <div class="relative h-auto md:w-[480px] w-300px">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="font-bold text-lg"> Wishlist</h3>
                <form method="dialog">
                    <button
                        class="size-6 flex justify-center items-center shadow dark:shadow-gray-800 rounded-md btn-ghost">
                        <i data-feather="x" class="size-4"></i>
                    </button>
                </form>
            </div>
            <div class="p-6 text-center">

                <div class="relative overflow-hidden text-transparent -m-3">
                    <i data-feather="hexagon" class="size-32 fill-red-600/5 mx-auto"></i>
                    <div
                        class="absolute top-2/4 -translate-y-2/4 start-0 end-0 mx-auto text-red-600 rounded-xl duration-500 text-4xl flex align-middle justify-center items-center">
                        <i class="uil uil-heart-break"></i>
                    </div>
                </div>
                <h4 class="text-xl font-semibold mt-6">Your wishlist is empty.</h4>
                <p class="text-slate-400 my-3">Create your first wishlist request...</p>
                <a href="#"
                    class="py-[5px] px-4 inline-block font-semibold tracking-wide align-middle duration-500 text-sm text-center bg-transparent hover:bg-indigo-600 border border-indigo-600 text-indigo-600 hover:text-white rounded-md mt-2">Create
                    a new wishlist</a>
            </div>
        </div>
    </dialog>

    <!-- End Modal -->