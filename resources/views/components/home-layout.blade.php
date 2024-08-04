<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../assets/css/style.css">

    <title>{{ config('app.name', 'Laravel') }}</title>

  </head>
  <body>

    <!-- Header -->
    <header id="header" class="header d-flex align-items-center bg-dark">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="{{ url('') }}" class="logo d-flex align-items-center text-dark text-decoration-none">
                <h1 class="text-white">{{ config('app.name', 'Laravel') }}</h1>
            </a>
            <!-- Navbar -->
            <nav class="main-nav navbar navbar-expand-md">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span>                         
                    </button>
                    <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link @if(Route::currentRouteName() =='home') active @endif" aria-current="page" href="{{ url('') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if(Route::currentRouteName() =='about') active @endif" aria-current="page" href="{{ url('/pages/about-us') }}">About Us</a>
                                </li>
                                @foreach(\App\Models\Category::withWhereHas('posts', function ($query) {
                                    $query->where('is_published', true);})
                                          ->take(5)->get() as $menu)
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{ URL::to('/category/' . $menu->slug) }}">{!!Illuminate\Support\Str::words($menu->name, 2, '')!!}</a>
                                </li>
                                @endforeach
                            </ul>                        
                            <div class="social-link d-flex align-items-center align-item-center">
                                <a href="#" class="text-white m-2"><i class="bi bi-facebook"></i></a>
                                <a href="#"class="text-white m-2"><i class="bi bi-twitter"></i></a>
                                <a href="#"class="text-white m-2"><i class="bi bi-instagram"></i></a>
                                <a href="#"class="text-white m-2"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!--End Navbar -->
        </div>
    </header><!-- End Header -->
    <x-auth-session-status class="alert alert-success" :status="session('status')" />
    @if(!Auth::user() AND Route::getRoutes()->match(Request::create(url()->previous()))->getName() == 'verification.verify')
        <div class="alert alert-success alert-dismissible" role="alert">
            Please Login to Verify Email!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{$slot}}
    <footer id="footer" class="d-flex align-items-center mt-5 bg-dark">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="footer-social-link col-md-12 d-flex justify-content-center">
                    <a href="#" class="ms-2 text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#"class="ms-2 text-white"><i class="bi bi-twitter"></i></a>
                    <a href="#"class="ms-2 text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#"class="ms-2 text-white"><i class="bi bi-youtube"></i></a>
                </div>
                <div class="copy-text text-white col-md-12 text-center mt-2">
                    @php
                        $fcc = \App\Models\Textinfo::where('key','footer-copy-text')->count();
                    @endphp
                    @if($fcc>0)
                    @foreach(\App\Models\Textinfo::where('key','footer-copy-text')->get() as $copy)
                        @if($copy->active == 1)
                            <p>{!! $copy->content !!} <a href="{{ $copy->link }}" class="text-white">{{ $copy->title }}</a></p>
                        @else
                            <p class="text-white"><a href="{{ url('') }}" class="text-white">{{ config('app.name', 'Laravel') }}</a> © Copyright, {{ \Carbon\Carbon::now()->format('Y')}}. All Rights Reserved.</p>
                        @endif
                    @endforeach
                    @else
                    <p class="text-white"><a href="{{ url('') }}" class="text-white">{{ config('app.name', 'Laravel') }}</a> © Copyright, {{ \Carbon\Carbon::now()->format('Y')}}. All Rights Reserved.</p>
                    @endif
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade",
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
  <!-- Add Active Class to Menu -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
    var path = window.location.href; // full url
    $('a[href="'+ path +'"]').addClass('active'); // find by selector url
  </script><!-- End Active Class Script --> 
  </body>
</html>