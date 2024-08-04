<x-home-layout>

    <!-- Main Page -->
  <div id="main">
    <div class="container">
        <!-- Featured Carousel -->
        @if($featureds->isNotEmpty())
          <section id="featured-carousel">
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($featureds as $featured)
                        <div class="swiper-slide">
                            <a href="{{ URL::to('/' . $featured->slug) }}"><img src="/storage/{{$featured->image}}" /></a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
          </section><!-- End Featured Carousel -->
        @endif
        <!-- Inner Content -->
        <section id="inner-content">
            <div class="row mt-5">
                <!-- Latest Post -->
                <div class="latest-post col-md-9">
                    <h2 class="text-center border-bottom">Latest Post</h2>
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="main-post col-md-4">
                                <div class="post-img">
                                    <img src="/storage/{{$post->image}}" alt="" class="img-fluid img-home-list">
                                    <div class="overlay"></div>
                                    @auth
                                    <a href="#" onclick="document.getElementById('like-form-{{$post->id}}').submit();" class="post-like"><i class="bi bi-heart-fill" style="color:{{Auth::user()->likedPosts()->where('post_id', $post->id)->count() >0 ? 'red' : ''}}"></i></a>
                                    <form action="{{route('postlike',$post->id)}}" method="POST" style="display:none;" id="like-form-{{$post->id}}">
                                        @csrf
                                    </form>
                                    @endauth
                                </div>
                                <div class="post-meta">
                                    <p>{{$post->category->name}}<span> // {{$post->user->name}} //</span><span> {{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></p>
                                </div>
                                <h3><a href="{{ URL::to('/' . $post->slug) }}">{{$post->title}}</a></h3>
                                <p>{!!Illuminate\Support\Str::words($post->content, 100, '...')!!}</p>
                                <div class="post-stats">
                                    <p><i class="bi bi-eye-fill"></i> {{$post->view_count}}<span> // <i class="bi bi-heart-fill"></i> {{$post->likedUsers->count()}}</span> // <span><i class="bi bi-chat-dots-fill"></i> {{$post->comments_count}}</span></p>
                                </div>
                            </div>
                        @endforeach
                        <!-- Pagination Link -->
                        <div class="pagination-link text-center mt-2 mb-2">
                            <nav class="blog-pagination" aria-label="Pagination">
                                @if($posts->hasmorePages())
                                    @if ($posts->onFirstPage())
                                        <a class="btn btn-outline-primary rounded-pill" href="{{ $posts->nextPageUrl() }}">Older</a>
                                        <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
                                    @elseif($posts->onLastPage())
                                        <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Older</a>
                                        <a class="btn btn-outline-primary rounded-pill" href="{{ $posts->previousPageUrl() }}">Newer</a>
                                    @else
                                        <a class="btn btn-outline-primary rounded-pill" href="{{ $posts->nextPageUrl() }}">Older</a>
                                        <a class="btn btn-outline-primary rounded-pill" href="{{ $posts->previousPageUrl() }}">Newer</a>
                                    @endif
                                @elseif($posts->onFirstPage())
                                    <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
                                    <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Older</a>
                                @else
                                    <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Older</a>
                                    <a class="btn btn-outline-primary rounded-pill" href="{{ $posts->previousPageUrl() }}">Newer</a>
                                @endif
                            </nav> 
                        </div><!-- End Pagination Link -->
                    </div><!-- End Latest Post Inside Row -->
                </div><!-- End Latest Post -->
                <!-- Home Sidebar -->
                <div class="home-sidebar col-md-3">
                    <h2 class="text-center border-bottom">Sidebar</h2>
                    <!-- User Area Widget -->
                    <div class="widget user-area-widget border border-1 p-2">
                        <h3 class="widget-heading text-decoration-underline text-center">User Area</h3>
                        @auth
                            <p>Hello <b>{{ Auth::user()->name }}</b></p>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <div class="d-grid gap-2 mt-2">
                                    <input type="submit" class="btn btn-warning" value="Logout">
                                </div>
                            </form>
                        @else
                            <form action="{{ route('login') }}" class="p-2" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email" required :value="old('email')">
                                </div>
                                <div class="mb-3">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox">
                                    <label class="form-check-label" for="checkbox">Remember Me</label>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <input type="submit" class="btn btn-success" value="Login">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#forgot-password-modal">Forgot Password</a>
                                </div>
                            </form>
                            <div class="d-grid gap-2 mt-2">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user-registration-modal">Register</a>
                            </div>
                        @endauth
                    </div><!-- End User Area Widget -->
                    <!-- About Us Widget -->
                    <div class="widget about-us-widget border border-1 mt-2 p-2">
                        @php
                          $awc = \App\Models\Textinfo::where('key','footer-about-us')->count();
                        @endphp
                        @if($awc>0)
                          @foreach(\App\Models\Textinfo::where('key','footer-about-us')->get() as $about)
                            @if($about->active == 1)
                              <h3 class="widget-heading text-decoration-underline text-center">{{$about->title}}</h3>
                              <p>{!!$about->content!!}</p>
                              <div class="d-grid gap-2">
                                <a href="{{$about->link}}" class="btn btn-secondary">Learn More</a>
                              </div>
                            @else
                              <h3 class="widget-heading text-decoration-underline text-center">About Us</h3>
                              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam pariatur, delectus voluptatem hic suscipit voluptas quis ipsam fugiat doloribus dicta ipsum qui quasi sunt sapiente! Perferendis, eaque? Officiis, ipsam. Recusandae.</p>
                              <div class="d-grid gap-2">
                                  <a href="#" class="btn btn-secondary">Learn More</a>
                              </div>
                            @endif
                          @endforeach
                        @else
                          <h3 class="widget-heading text-decoration-underline text-center">About Us</h3>
                          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam pariatur, delectus voluptatem hic suscipit voluptas quis ipsam fugiat doloribus dicta ipsum qui quasi sunt sapiente! Perferendis, eaque? Officiis, ipsam. Recusandae.</p>
                          <div class="d-grid gap-2">
                              <a href="#" class="btn btn-secondary">Learn More</a>
                          </div>
                        @endif                            
                    </div><!-- End About Us Widget -->
                    <!-- Trending Widget -->
                    <div class="widget tending-widget border border-1 mt-2 p-2">
                        <h3 class="widget-heading text-decoration-underline text-center">Trending</h3>
                        @foreach($trendings as $index=>$trending)
                          <div class="post-trending d-flex align-items-center justify-content-start position-relative">
                              <img src="/storage/{{$trending->image}}" class="img-thumbnail" alt="">
                              <a href="{{ URL::to('/' . $trending->slug) }}"><p class="pt-2"><strong>{{$trending->title}}</strong></p></a>
                              <span class="position-absolute top-20 start-0 translate-middle badge rounded-pill bg-danger">
                                {{$index+1}}
                              </span>
                          </div>                                               
                        @endforeach
                    </div><!-- End Trending Widget -->
                </div><!-- End Home Sidebar -->
            </div> <!-- End Row Inner Content -->
        </section><!-- End Inner Content -->
        <!-- Category -->
        <section id="category">
        @foreach($categories as $category)
            <div class="row border-bottom mt-5">
                <div class="col-md-10">
                    <div class="category-header">
                        <h2>{{$category->name}}</h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="category-cta">
                        <a href="{{ URL::to('/category/' . $category->slug) }}">See All Post</a>
                    </div>
                </div>
            </div>
            <!-- Inner Category Content-->
            <div class="row mt-5">
                @foreach($category->posts as $catpost)
                    <div class="main-post col-md-3">
                        <div class="post-img">
                            <img src="/storage/{{$catpost->image}}" alt="" class="img-fluid img-home-list">
                            <div class="overlay"></div>
                            <a href="#" class="post-like"><i class="bi bi-heart-fill"></i></a>
                        </div>
                        <div class="post-meta">
                            <p>By:- {{$catpost->user->name}} //</span><span> {{ \Carbon\Carbon::parse($catpost->created_at)->format('j F, Y')}}</span></p>
                        </div>
                        <h3><a href="{{ URL::to('/' . $catpost->slug) }}">{{$catpost->title}}</a></h3>
                        <p>{!!Illuminate\Support\Str::words($catpost->content, 100, '...')!!}</p>
                        <div class="post-stats">
                            <p><i class="bi bi-eye-fill"></i> {{$catpost->view_count}}<span> // <i class="bi bi-heart-fill"></i> {{$catpost->likedUsers->count()}}</span> // <span><i class="bi bi-chat-dots-fill"></i> {{$catpost->comments_count}}</span></p>
                        </div>
                    </div>
                @endforeach
            </div><!-- End Inner Category Content-->
        @endforeach
        </section><!-- End Category -->
    </div><!-- End Container -->
</div><!-- End Main Page -->

<!-- Modals for Register & Forgot Password -->
<!-- Forgot Password Modal-->
<div class="modal fade" id="forgot-password-modal" tabindex="-1" aria-labelledby="forgot-password-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="fpModalLabel">Forgot Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" id="fpm-email" name="email" class="form-control" placeholder="Enter your Email" required :value="old('email')">
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-success" value="Email Password Reset Link">
            </div>
        </form>
        </div>
    </div>
    </div>
</div>

<!-- Registration Modal-->
<div class="modal fade" id="user-registration-modal" tabindex="-1" aria-labelledby="user-registration-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="usModalLabel">Create an Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" id="urm-name" name="name" class="form-control" placeholder="Enter your Name" required :value="old('name')">
            </div>
            <div class="mb-3">
                <input type="email" id="urm-email" name="email" class="form-control" placeholder="Enter your Email" required :value="old('email')">
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" id="urm-password" placeholder="Enter Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" id="urm-password_confirmation" placeholder="Re-enter Password" required>
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-success" value="Create Account">
            </div>
        </form>
        </div>
    </div>
    </div>
</div><!-- End Modals for Register & Forgot Password -->



</x-home-layout>