<x-guest-layout>
  <main id="main">

    <!-- ======= Hero Slider Section ======= -->
    @if(isset($featureds))
      <section id="hero-slider" class="hero-slider">
        <div class="container-md" data-aos="fade-in">
          <div class="row">
            <div class="col-12">
              <div class="swiper sliderFeaturedPosts">
                <div class="swiper-wrapper">
                  @foreach($featureds as $featured)
                  <div class="swiper-slide">
                    <a href="{{ URL::to('/post/' . $featured->slug) }}" class="img-bg d-flex align-items-end" style="background-image: url('/storage/{{$featured->image}}');">
                      <div class="img-bg-inner">
                        <h2>{{$featured->title}}</h2>
                        <p>{!!Illuminate\Support\Str::words($featured->content, 100, '...')!!}</p>
                      </div>
                    </a>
                  </div>
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
    @endif

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-4">
            <div class="post-entry-1 lg">
              @foreach($posts as $post)
                @once
                  <a href="{{ URL::to('/post/' . $post->slug) }}"><img src="/storage/{{$post->image}}" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">{{$post->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></div>
                  <div class="post-meta"><i class="bi bi-heart-fill"></i>{{$post->likedUsers->count()}} || <i class="bi bi-eye-fill"></i>{{$post->view_count}}
                    || <i class="bi bi-chat-dots-fill"></i>{{$post->comments_count}}
                  </div>
                  <h2><a href="{{ URL::to('/post/' . $post->slug) }}">{{$post->title}}</a></h2>
                  <p class="mb-4 d-block">{!!Illuminate\Support\Str::words($post->content, 100, '...')!!}</p>
    
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0">{{$post->user->name}}</h3>
                    </div>
                  </div>
                @endonce
                @endforeach 
            </div>
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
          
          <div class="col-lg-8">
            <div class="row g-5">
                  <div class="col-lg-8 border-start custom-border">
                    <div class="row">
                      @foreach($posts as $post)
                      @if ($loop->first) @continue @endif
                      <div class="col-lg-6">
                        <div class="post-entry-1">
                          <a href="{{ URL::to('/post/' . $post->slug) }}"><img src="/storage/{{$post->image}}" alt="" class="img-fluid"></a>
                          <div class="post-meta"><span class="date">{{$post->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></div>
                          <div class="post-meta"><i class="bi bi-heart-fill"></i>{{$post->likedUsers->count()}} || <i class="bi bi-eye-fill"></i>{{$post->view_count}}
                            || <i class="bi bi-chat-dots-fill"></i>{{$post->comments_count}}
                          </div>
                          <h2><a href="{{ URL::to('/post/' . $post->slug) }}">{{$post->title}}</a></h2>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>

              <!-- Trending Section -->
              <div class="col-lg-4">

                <div class="trending">
                  <h3>Trending</h3>
                  <ul class="trending-post">
                    @foreach($trendings as $index=>$trending)
                    <li>
                      <a href="{{ URL::to('/post/' . $trending->slug) }}">
                        <span class="number">{{$index+1}}</span>
                        <h3>{{$trending->title}}</h3>
                        <span class="author">{{$trending->user->name}}</span>
                      </a>
                    </li>
                    @endforeach
                  </ul>
                </div>

              </div> <!-- End Trending Section -->
            </div>
          </div>

        </div> <!-- End .row -->
      </div>
    </section> <!-- End Post Grid Section -->

    <!-- ======= Culture Category Section ======= -->
    <section class="category-section">
      <div class="container" data-aos="fade-up">
        @foreach($categories as $category)
        @if(count($category->posts)>0)
          
        <div class="section-header d-flex justify-content-between align-items-center mb-5">
          <h2>{{$category->name}}</h2>
          <div><a href="category.html" class="more">See All {{$category->name}}</a></div>
        </div>
        

        <div class="row">
          <div class="col-md-4">
                <div class="post-entry-1 lg">
                    <div class="swiper sliderFeaturedPosts">
                      <div class="swiper-wrapper">
                        @foreach($category->posts as $catpost)
                        @if($catpost->is_featured == 1)
                        <div class="swiper-slide">
                          <a href="{{ URL::to('/post/' . $catpost->slug) }}" class="img-bg d-flex align-items-end" style="background-image: url('/storage/{{$catpost->image}}');">
                            <div class="img-bg-inner">
                              <h2>{{$catpost->title}}</h2>
                              <p>{!!Illuminate\Support\Str::words($catpost->content, 50, '...')!!}</p>
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
          <div class="col-md-8">
            <div class="row">
              @foreach($category->posts as $catpost)
              @if($loop->iteration<=4)
              <div class="col-md-3">
                <div class="post-entry-1 border-bottom">
                  <a href="{{ URL::to('/post/' . $catpost->slug) }}"><img src="/storage/{{$catpost->image}}" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">{{$category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($catpost->created_at)->format('j F, Y')}}</span></div>
                  <div class="post-meta"><i class="bi bi-heart-fill"></i>{{$post->likedUsers->count()}} || <i class="bi bi-eye-fill"></i>{{$catpost->view_count}}</div>
                  <h2><a href="{{ URL::to('/post/' . $catpost->slug) }}">{{$catpost->title}}</a></h2>
                </div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      @endif
      @endforeach
      </div>
    </section><!-- End Culture Category Section -->

  </main><!-- End #main -->
</x-guest-layout>
      