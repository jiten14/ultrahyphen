<x-guest-layout>
  <main id="main">

    <!-- ======= Hero Slider Section ======= -->
      <section id="hero-slider" class="hero-slider">
        <div class="container-md" data-aos="fade-in">
          <div class="row">
            <div class="col-12">
              <div class="swiper sliderFeaturedPosts">
                <div class="swiper-wrapper">
                  @foreach($posts as $post)
                  @if($post->is_featured == 1)
                  <div class="swiper-slide">
                    <a href="{{ URL::to('/' . $post->slug) }}" class="img-bg d-flex align-items-end" style="background-image: url('/storage/{{$post->image}}');">
                      <div class="img-bg-inner">
                        <h2>{{$post->title}}</h2>
                        <p>{!!Illuminate\Support\Str::words($post->content, 100, '...')!!}</p>
                      </div>
                    </a>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="custom-swiper-button-next">
                  <span class="bi-chevron-right"></span>
                </div>
                <div class="custom-swiper-button-prev">
                  <span class="bi-chevron-left"></span>
                </div>

                <div class="swiper-pagination"></div>
              </div>
            </div>
          </div>
        </div>
      </section><!-- End Hero Slider Section -->      

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="section-header d-flex justify-content-between align-items-center mb-5">
          <h2>{{$slug}}</h2>
        </div>
        <div class="row g-5">
          @foreach($posts as $post)
          <div class="col-lg-4">
            <div class="post-entry-1 lg">
                  <a href="{{ URL::to('/' . $post->slug) }}"><img src="/storage/{{$post->image}}" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">{{$post->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></div>
                  <div class="post-meta"><i class="bi bi-heart-fill"></i>{{$post->likedUsers->count()}} || <i class="bi bi-eye-fill"></i>{{$post->view_count}}
                    || <i class="bi bi-chat-dots-fill"></i>{{$post->comments_count}}
                  </div>
                  <h2><a href="{{ URL::to('/' . $post->slug) }}">{{$post->title}}</a></h2>
                  <p class="mb-4 d-block">{!!Illuminate\Support\Str::words($post->content, 100, '...')!!}</p>
    
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0">{{$post->user->name}}</h3>
                    </div>
                  </div>
            </div>
          </div>
          @endforeach
        </div> <!-- End .row -->
        <div class="row g-5 text-center">
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
        </div>
      </div>
    </section> <!-- End Post Grid Section -->
  </main><!-- End #main -->
</x-guest-layout>
      