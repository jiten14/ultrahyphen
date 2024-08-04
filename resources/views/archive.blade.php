<x-home-layout>

    <!-- Main Page -->
  <div id="main">
    <div class="container">
        <!-- Featured Carousel -->
          <section id="featured-carousel">
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @if(isset($category))
                        @foreach($category->posts as $featured)
                        @if($featured->is_featured == 1)
                            <div class="swiper-slide">
                                <a href="{{ URL::to('/' . $featured->slug) }}"><img src="/storage/{{$featured->image}}" /></a>
                            </div>
                        @endif
                        @endforeach
                    @else
                        @foreach($posts as $post)
                        @if($post->is_featured == 1)
                            <div class="swiper-slide">
                                <a href="{{ URL::to('/' . $post->slug) }}"><img src="/storage/{{$post->image}}" /></a>
                            </div>
                        @endif
                        @endforeach
                    @endif
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
          </section><!-- End Featured Carousel -->
        <!-- Inner Content -->
        <section id="inner-content">
            <div class="row mt-5">
                <!-- Latest Post -->
                <div class="latest-post col-md-12">
                    @if(isset($category))
                        <h2 class="text-center border-bottom">Category:- {{$category->name}}</h2>
                    @else
                        <h2 class="text-center border-bottom">Tag:- {{$slug}}</h2>
                    @endif
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="main-post col-md-3">
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
            </div> <!-- End Row Inner Content -->
        </section><!-- End Inner Content -->
    </div><!-- End Container -->
</div><!-- End Main Page -->
</x-home-layout>