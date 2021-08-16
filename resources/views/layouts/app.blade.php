<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- css style -->
    <!-- css style -->
    @stack('prepend-style')
    @include('includes.style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    @stack('addon-style')
    
    
  </head>

  <body>
    <!-- Navbar -->
    @include('includes.navbar')

    <!-- Page Content -->
    @yield('content')
    <div class="container"> 
                
                

    <!-- Footer -->
    @include('includes.footer')

  
   <!-- script -->
    @stack('prepend-script')
    @include('includes.script');
    @stack('addon-script')
    
  </body>
</html>
