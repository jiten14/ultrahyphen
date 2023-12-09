<x-guest-layout>
  {{--<div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-between">
      @foreach($navs as $nav)
                  @if(($nav->published_posts_count > 0))
                  <a class="nav-item nav-link link-body-emphasis active" href="#">{{$nav->name}}</a>
                  @endif
                @endforeach
    </nav>
    </div>
      <main class="container">
      @if(isset($featured))
      <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary" style="background-image: url(/storage/{{$featured->image}});
      background-size: cover;">
      <div class="col-lg-6 px-0">
        <h1 class="display-4 fst-italic text-white">{{$featured->title}}</h1>
        <p class="lead my-3 text-white">{{$featured->content}}</p>
        <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
      </div>
      </div>
      @endif

      <div class="row mb-2">
      <div class="col-md-9">
        <div class="row">
          @foreach( $posts as $post)
            <div class="col-md-6">
              <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <strong class="d-inline-block mb-2 text-primary-emphasis">{{$post->category->name}}</strong>
                  <h3 class="mb-0">{{ Illuminate\Support\Str::limit($post->title, 10, '...') }}</h3>
                  <div class="mb-1 text-body-secondary">{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</div>
                  <p class="card-text mb-auto">{{ Illuminate\Support\Str::words($post->content, 10, '...') }}</p>
                  <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                    Continue reading
                    <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                  </a>
                </div>
                <div class="col-auto d-none d-lg-block">
                  <img src="storage/{{ $post->image }}" alt="" width="200" height="250">
                </div>
              </div>
            </div>
            @endforeach
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
      <div class="col-md-3">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 bg-body-tertiary rounded">
            <h4 class="fst-italic">About</h4>
            <p class="mb-0">Application now under Development. Making with Love by Jitendriya.I will write in details about me later. Stay Tuned!</p>
          </div>

          <div class="p-4 mb-3 bg-body-tertiary rounded">
            <h4 class="fst-italic">Topics</h4>
            @foreach($categories as $category)
              @if(($category->published_posts_count > 0))
                <button type="button" class="btn btn-primary mt-2">
                  {{ Illuminate\Support\Str::limit($category->name, 4) }}
                    <span class="badge text-bg-secondary">{{ $category->published_posts_count }}</span>
                </button>
              @endif  
            @endforeach
          </div>

          <div class="p-4 mb-3 bg-body-tertiary rounded">
            <h4 class="fst-italic">Recent comments</h4>
            <ul class="list-unstyled">
              @foreach($comments as $comment)
                @if($comment->published_post_count > 0)
                  <li>
                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                      <div class="col-lg-8">
                        <h6 class="mb-0">{{ Illuminate\Support\Str::words($comment->content, 4, '...') }}</h6>
                        <small class="fw-bold text-info">{{ $comment->user->name }} //</small>
                        <small class="text-body-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                      </div>
                    </a>
                  </li>
                @endif
              @endforeach
            </ul>
          </div>
          <div class="p-4 mb-3 bg-body-tertiary rounded">
            <h4 class="fst-italic">Tags</h4>
            @foreach($tags as $tag)
              @if(($tag->published_posts_count > 0))
                <button type="button" class="btn btn-primary mt-2">
                  {{$tag->name}} 
                  <span class="badge text-bg-secondary">{{$tag->published_posts_count}}</span>
                </button>
              @endif  
            @endforeach
          </div>
        </div>
      </div>
      </div>
      <div class="container marketing">
      <div class="row">
        <h1 class="text-center">Authors</h1>
        <hr/>
        @foreach($authors as $author)
          @if(($author->published_posts_count > 0))
            <div class="col-lg-4">
              <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg>
              <h2 class="fw-normal">{{$author->name}}</h2>
              <p>Email:- {{$author->email}}</p>
              <button type="button" class="btn btn-success position-relative">
                View Posts
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{$author->published_posts_count}}
                </span>
              </button>
            </div><!-- /.col-lg-4 -->
          @endif
        @endforeach
      </div><!-- /.row -->
      </div>
      </main>--}}
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
                        <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('/storage/{{$featured->image}}');">
                          <div class="img-bg-inner">
                            <h2>{{$featured->title}}</h2>
                            <p>{{$featured->content}}</p>
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
                      <a href="single-post.html"><img src="/storage/{{$post->image}}" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">{{$post->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></div>
                      <h2><a href="single-post.html">{{$post->title}}</a></h2>
                      <p class="mb-4 d-block">{{$post->content}}</p>
        
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
                              <a href="single-post.html"><img src="/storage/{{$post->image}}" alt="" class="img-fluid"></a>
                              <div class="post-meta"><span class="date">{{$post->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></div>
                              <h2><a href="single-post.html">{{$post->title}}</a></h2>
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
                        <li>
                          <a href="single-post.html">
                            <span class="number">1</span>
                            <h3>The Best Homemade Masks for Face (keep the Pimples Away)</h3>
                            <span class="author">Jane Cooper</span>
                          </a>
                        </li>
                        <li>
                          <a href="single-post.html">
                            <span class="number">2</span>
                            <h3>17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</h3>
                            <span class="author">Wade Warren</span>
                          </a>
                        </li>
                        <li>
                          <a href="single-post.html">
                            <span class="number">3</span>
                            <h3>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h3>
                            <span class="author">Esther Howard</span>
                          </a>
                        </li>
                        <li>
                          <a href="single-post.html">
                            <span class="number">4</span>
                            <h3>9 Half-up/half-down Hairstyles for Long and Medium Hair</h3>
                            <span class="author">Cameron Williamson</span>
                          </a>
                        </li>
                        <li>
                          <a href="single-post.html">
                            <span class="number">5</span>
                            <h3>Life Insurance And Pregnancy: A Working Mom’s Guide</h3>
                            <span class="author">Jenny Wilson</span>
                          </a>
                        </li>
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
    
            <div class="section-header d-flex justify-content-between align-items-center mb-5">
              <h2>Culture</h2>
              <div><a href="category.html" class="more">See All Culture</a></div>
            </div>
    
            <div class="row">
              <div class="col-md-9">
    
                <div class="d-lg-flex post-entry-2">
                  <a href="single-post.html" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                    <img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid">
                  </a>
                  <div>
                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
                    <div class="d-flex align-items-center author">
                      <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid"></div>
                      <div class="name">
                        <h3 class="m-0 p-0">Wade Warren</h3>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="row">
                  <div class="col-lg-4">
                    <div class="post-entry-1 border-bottom">
                      <a href="single-post.html"><img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                      <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                    </div>
    
                    <div class="post-entry-1">
                      <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                      <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                    </div>
                  </div>
                </div>
              </div>
    
              <div class="col-md-3">
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
              </div>
            </div>
          </div>
        </section><!-- End Culture Category Section -->
    
        <!-- ======= Business Category Section ======= -->
        <section class="category-section">
          <div class="container" data-aos="fade-up">
    
            <div class="section-header d-flex justify-content-between align-items-center mb-5">
              <h2>Business</h2>
              <div><a href="category.html" class="more">See All Business</a></div>
            </div>
    
            <div class="row">
              <div class="col-md-9 order-md-2">
    
                <div class="d-lg-flex post-entry-2">
                  <a href="single-post.html" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
                    <img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid">
                  </a>
                  <div>
                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                    <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
                    <div class="d-flex align-items-center author">
                      <div class="photo"><img src="assets/img/person-4.jpg" alt="" class="img-fluid"></div>
                      <div class="name">
                        <h3 class="m-0 p-0">Wade Warren</h3>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="row">
                  <div class="col-lg-4">
                    <div class="post-entry-1 border-bottom">
                      <a href="single-post.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                      <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                    </div>
    
                    <div class="post-entry-1">
                      <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                      <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
              </div>
            </div>
          </div>
        </section><!-- End Business Category Section -->
    
        <!-- ======= Lifestyle Category Section ======= -->
        <section class="category-section">
          <div class="container" data-aos="fade-up">
    
            <div class="section-header d-flex justify-content-between align-items-center mb-5">
              <h2>Lifestyle</h2>
              <div><a href="category.html" class="more">See All Lifestyle</a></div>
            </div>
    
            <div class="row g-5">
              <div class="col-lg-4">
                <div class="post-entry-1 lg">
                  <a href="single-post.html"><img src="assets/img/post-landscape-8.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                  <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil tempore odit ab minus eveniet praesentium, similique blanditiis molestiae ut saepe perspiciatis officia nemo, eos quae cumque. Accusamus fugiat architecto rerum animi atque eveniet, quo, praesentium dignissimos</p>
    
                  <div class="d-flex align-items-center author">
                    <div class="photo"><img src="assets/img/person-7.jpg" alt="" class="img-fluid"></div>
                    <div class="name">
                      <h3 class="m-0 p-0">Esther Howard</h3>
                    </div>
                  </div>
                </div>
    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
                <div class="post-entry-1">
                  <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>
    
              </div>
    
              <div class="col-lg-8">
                <div class="row g-5">
                  <div class="col-lg-4 border-start custom-border">
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-6.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2><a href="single-post.html">Let’s Get Back to Work, New York</a></h2>
                    </div>
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 17th '22</span></div>
                      <h2><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                    </div>
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-4.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Mar 15th '22</span></div>
                      <h2><a href="single-post.html">Why Craigslist Tampa Is One of The Most Interesting Places On the Web?</a></h2>
                    </div>
                  </div>
                  <div class="col-lg-4 border-start custom-border">
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2><a href="single-post.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
                    </div>
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Mar 1st '22</span></div>
                      <h2><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                    </div>
                    <div class="post-entry-1">
                      <a href="single-post.html"><img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
                    </div>
                  </div>
                  <div class="col-lg-4">
    
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
    
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
    
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
    
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
    
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
    
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                      <h2 class="mb-2"><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                      <span class="author mb-3 d-block">Jenny Wilson</span>
                    </div>
    
                  </div>
                </div>
              </div>
    
            </div> <!-- End .row -->
          </div>
        </section><!-- End Lifestyle Category Section -->
    
      </main><!-- End #main -->
</x-guest-layout>
      