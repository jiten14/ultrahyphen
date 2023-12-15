<x-guest-layout>
<main id="main">
    @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
    @endif
    <section class="single-post-content">
      <div class="container">
        <div class="row">
          <div class="col-md-9 post-content" data-aos="fade-up">

            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
              <div class="post-meta"><span class="date">{{$post->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></div>
              @auth
                <div class="post-meta">
                  <span class="date">
                    <a href="#" onclick="document.getElementById('like-form-{{$post->id}}').submit();"><i class="bi bi-heart-fill" style="color:{{Auth::user()->likedPosts()->where('post_id', $post->id)->count() >0 ? 'red' : ''}}"></i></a>
                    {{$post->likedUsers->count()}}
                    || <i class="bi bi-eye-fill"></i>{{$post->view_count}}
                    || <i class="bi bi-chat-dots-fill"></i>{{count($comments)}}
                  </span>
                </div>
                <form action="{{route('postlike',$post->id)}}" method="POST" style="display:none;" id="like-form-{{$post->id}}">
                @csrf
                </form>
              @else
                <div class="post-meta">
                  <span class="date">
                    <i class="bi bi-heart-fill"></i>{{$post->likedUsers->count()}}
                    || <i class="bi bi-eye-fill"></i>{{$post->view_count}}
                    || <i class="bi bi-chat-dots-fill"></i>{{count($comments)}}
                  </span>
                </div>
              @endauth
              <h1 class="mb-5">{{$post->title}}</h1>
              <p>{!!$post->content!!}</p>
            </div><!-- End Single Post Content -->

            <!-- ======= Comments ======= -->
            <div class="comments">
                <h5 class="comment-title py-4">
                    @if(count($comments)== 0)
                      No Comments
                    @elseif(count($comments)==1)
                      {{count($comments)}} Comment
                    @else
                        {{count($comments)}} Comments
                    @endif
                </h5>
                @foreach($comments as $comment)
              <div class="comment d-flex mb-4">
                <div class="flex-shrink-0">
                  <div class="avatar avatar-sm rounded-circle">
                    <img class="avatar-img" src="../assets/img/person-5.jpg" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="flex-grow-1 ms-2 ms-sm-3">
                  <div class="comment-meta d-flex align-items-baseline">
                    <h6 class="me-2">{{$comment->user->name}}</h6>
                    <span class="text-muted">{{ $comment->updated_at->diffForHumans() }}</span>
                    @if($comment->user->is(auth()->user()))
                    &nbsp;&nbsp;<a href="#" class="text-info"  data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</a>&nbsp;//&nbsp;
                      <form method="POST" action="{{ URL::to('/comment/delete/' . $comment->id) }}">
                        @csrf
                        @method('delete')
                        <a href="{{ URL::to('/comment/delete/' . $comment->id) }}" class="text-danger" onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                      </form>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="{{ URL::to('/comment/update/' . $comment->id) }}">
                                @csrf
                                @method('patch')
                              <div class="col-12 mb-3">
                                <textarea class="form-control" name="comment-message" id="comment-message" placeholder="Enter your message" cols="30" rows="10">{{$comment->content}}</textarea>
                              </div>
                              <div class="col-12">
                                <input type="submit" class="btn btn-primary" value="Update comment">
                              </div>
                            </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                  <div class="comment-body">
                    {{$comment->content}}
                  </div>

                  {{--<div class="comment-replies bg-light p-3 mt-3 rounded">
                    <h6 class="comment-replies-title mb-4 text-muted text-uppercase">2 replies</h6>

                    <div class="reply d-flex mb-4">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                          <img class="avatar-img" src="assets/img/person-4.jpg" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="reply-meta d-flex align-items-baseline">
                          <h6 class="mb-0 me-2">Brandon Smith</h6>
                          <span class="text-muted">2d</span>
                        </div>
                        <div class="reply-body">
                          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        </div>
                      </div>
                    </div>
                    <div class="reply d-flex">
                      <div class="flex-shrink-0">
                        <div class="avatar avatar-sm rounded-circle">
                          <img class="avatar-img" src="assets/img/person-3.jpg" alt="" class="img-fluid">
                        </div>
                      </div>
                      <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="reply-meta d-flex align-items-baseline">
                          <h6 class="mb-0 me-2">James Parsons</h6>
                          <span class="text-muted">1d</span>
                        </div>
                        <div class="reply-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio dolore sed eos sapiente, praesentium.
                        </div>
                      </div>
                    </div>
                  </div>--}}
                </div>
              </div>
              @endforeach
            </div><!-- End Comments -->

            <!-- ======= Comments Form ======= -->
            
            <div class="row justify-content-center mt-5">

              <div class="col-lg-12">
                @auth
                  @if(Auth::user()->hasVerifiedEmail())
                    <h5 class="comment-title">Leave a Comment</h5>
                    <div class="row">
                    <form method="post" action="{{ URL::to('/comment/post/' . $post->id) }}">
                        @csrf
                      <div class="col-12 mb-3">
                        <textarea class="form-control" name="comment-message" id="comment-message" placeholder="Enter your message" cols="30" rows="10"></textarea>
                      </div>
                      <div class="col-12">
                        <input type="submit" class="btn btn-primary" value="Post comment">
                      </div>
                    </form>
                    </div>
                  @else
                    <h5 class="comment-title">Please Verify your Email to Leave a Comment</h5>
                  @endif
                @else
                    <h5 class="comment-title">Please Login to Leave a Comment</h5>
                @endauth
              </div>
            </div><!-- End Comments Form -->

          </div>
          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
            <div class="aside-block">

              <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Trending</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest</button>
                </li>
              </ul>

              <div class="tab-content" id="pills-tabContent">

                <!-- Popular -->
                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                  @foreach($populars as $popular)
                  <div class="post-entry-1 border-bottom">
                    <div class="post-meta"><span class="date">{{$popular->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($popular->created_at)->format('j F, Y')}}</span></div>
                    <h2 class="mb-2"><a href="{{ URL::to('/' . $popular->slug) }}">{{$popular->title}}</a></h2>
                    <span class="author mb-3 d-block">{{$popular->user->name}}</span>
                  </div>
                  @endforeach
                </div> <!-- End Popular -->

                <!-- Trending -->
                <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                  @foreach($trendings as $trending)
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">{{$trending->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($trending->created_at)->format('j F, Y')}}</span></div>
                      <h2 class="mb-2"><a href="{{ URL::to('/' . $trending->slug) }}">{{$trending->title}}</a></h2>
                      <span class="author mb-3 d-block">{{$trending->user->name}}</span>
                    </div>
                  @endforeach
                </div> <!-- End Trending -->

                <!-- Latest -->
                <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                  @foreach($latestposts as $lpost)
                    <div class="post-entry-1 border-bottom">
                      <div class="post-meta"><span class="date">{{$lpost->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($lpost->created_at)->format('j F, Y')}}</span></div>
                      <h2 class="mb-2"><a href="{{ URL::to('/' . $lpost->slug) }}">{{$lpost->title}}</a></h2>
                      <span class="author mb-3 d-block">{{$lpost->user->name}}</span>
                    </div>
                  @endforeach
                </div> <!-- End Latest -->

              </div>
            </div>

            <div class="aside-block">
              <h3 class="aside-title">Categories</h3>
              <ul class="aside-links list-unstyled">
                @foreach($categories as $category)
                  <li><a href="category.html"><i class="bi bi-chevron-right"></i>{{$category->name}}
                        <span class="badge rounded-pill bg-danger">{{count($category->posts)}}</span>
                      </a>
                  </li>
                @endforeach
              </ul>
            </div><!-- End Categories -->

            <div class="aside-block">
              <h3 class="aside-title">Tags</h3>
              <ul class="aside-tags list-unstyled">
                @foreach($tags as $tag)
                  @if(($tag->published_posts_count > 0))
                    <li><a href="category.html">{{$tag->name}}</a></li>
                  @endif
                @endforeach
              </ul>
            </div><!-- End Tags -->

          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
</x-guest-layout>  