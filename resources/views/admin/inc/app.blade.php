<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Trang Admin')
    </title>
    
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/tailwind.output.css') }}" />
    
    <!-- Alpine.js -->
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    
    <!-- Local JS - Init Alpine -->
    <script src="{{ asset('admin/assets/js/init-alpine.js') }}"></script>
    
    <!-- Chart.js CSS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    
    <!-- Chart.js JS -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    
    <!-- Local JS - Charts -->
    <script src="{{ asset('admin/assets/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('admin/assets/js/charts-pie.js') }}" defer></script>
</head>
<body>
    <div class="flex bg-white dark:bg-gray-800 min-h-screen	">
        @include('admin.inc.sidebar') 
        <div class="flex flex-col flex-1 w-full">
            @include('admin.inc.header')
            
            @yield('content')
        </div>
          
    
    @include('admin.inc.footer')
</body>

</html>