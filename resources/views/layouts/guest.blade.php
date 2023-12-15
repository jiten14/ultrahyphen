<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="../assets/css/variables.css" rel="stylesheet">
  <link href="../assets/css/main.css" rel="stylesheet">
  
</head>

<body>

  <!-- ======= Header ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://twitter.com/" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/" class="instagram"><i class="bi bi-instagram"></i></a>
      </div>
      <div class="contact-info d-flex align-items-center">
        @if (Route::has('login'))
          @auth
            {{--<i class="bi bi-speedometer2 d-flex align-items-center"><a href="{{ url('/user/dashboard') }}">Dashboard</a></i>--}}
            <form class="row g-3 needs-validation" method="POST" action="{{ route('logout') }}">
              @csrf
              <i class="bi bi-box-arrow-left d-flex align-items-center ms-4">
                <a href="{{ route('logout') }}"onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
              </i>
            </form>
          @else
            <i class="bi bi-box-arrow-in-right d-flex align-items-center"><a href="{{ route('login') }}">Login</a></i>
            @if (Route::has('register'))
              <i class="bi bi-person-add d-flex align-items-center ms-4"><a href="{{ route('register') }}">Register</a></i>
            @endif
          @endauth
        @endif
      </div>
    </div>
  </section><!-- End Top Bar -->
  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ url('') }}" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>{{ config('app.name', 'Laravel') }}</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          @foreach(\App\Models\Category::withWhereHas('posts', function ($query) {
            $query->where('is_published', true);})
                  ->take(5)->get() as $menu)
          <li><a href="{{ URL::to('/category/' . $menu->slug) }}">{{$menu->name}}</a></li>
          @endforeach
        </ul>
      </nav><!-- .navbar -->
      <i class="bi bi-list mobile-nav-toggle"></i>

    </div>

  </header><!-- End Header -->
      
  {{$slot}}
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

  <div class="footer-content">
    <div class="container">

      <div class="row g-5">
        <div class="col-lg-4">
          <h3 class="footer-heading">About ZenBlog</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
          <p><a href="about.html" class="footer-link-more">Learn More</a></p>
        </div>
        <div class="col-6 col-lg-4">
          <h3 class="footer-heading">Categories</h3>
          <ul class="footer-links list-unstyled">
            @foreach(\App\Models\Category::withWhereHas('posts', function ($query) {
            $query->where('is_published', true);})
                  ->take(8)->get() as $footercat)
            <li><a href="{{ URL::to('/category/' . $footercat->slug) }}"><i class="bi bi-chevron-right"></i> {{$footercat->name}}</a></li>
            @endforeach

          </ul>
        </div>

        <div class="col-lg-4">
          <h3 class="footer-heading">Recent Posts</h3>

          <ul class="footer-links footer-blog-entry list-unstyled">
            @foreach(\App\Models\Post::where('is_published', 1)->with('category')->latest()->take(4)->get() as $flpost)
              <li>
                <a href="{{ URL::to('/' . $flpost->slug) }}" class="d-flex align-items-center">
                  <img src="/storage/{{$flpost->image}}" alt="" class="img-fluid me-3">
                  <div>
                    <div class="post-meta d-block"><span class="date">{{$flpost->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($flpost->created_at)->format('j F, Y')}}</span></div>
                    <span>{{$flpost->title}}</span>
                  </div>
                </a>
              </li>
            @endforeach

          </ul>

        </div>
      </div>
    </div>
  </div>

  <div class="footer-legal">
    <div class="container">

      <div class="row justify-content-between">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <div class="copyright">
            <strong><a href="{{ url('') }}">{{ config('app.name', 'Laravel') }}</a></strong> © Copyright, {{ \Carbon\Carbon::now()->format('Y')}}. All Rights Reserved
          </div>

        </div>

        <div class="col-md-6">
          <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
            <a href="https://twitter.com/" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://www.facebook.com/" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/" class="instagram"><i class="bi bi-instagram"></i></a>
          </div>

        </div>

      </div>

    </div>
  </div>

</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>

</body>

</html>