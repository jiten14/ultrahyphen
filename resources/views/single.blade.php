<x-home-layout>
    <!-- Main Page -->
    <div id="main">
        <div class="container">
            <!-- Inner Content -->
            <section id="inner-content">
                <div class="row mt-5">
                    <!-- Single Post -->
                    <div class="latest-post col-md-8">
                        <h2 class="border-bottom">{{$post->title}}</h2>
                        <div class="post-img">
                            <img src="/storage/{{$post->image}}" alt="" class="img-fluid w-100 h-100">
                            <div class="overlay"></div>
                            <div class="img-hover-top-text">
                                <p class="single-hover">{{$post->category->name}}</p>
                            </div>
                            @auth
                            <a href="#" onclick="document.getElementById('like-form-{{$post->id}}').submit();" class="post-like"><i class="bi bi-heart-fill" style="color:{{Auth::user()->likedPosts()->where('post_id', $post->id)->count() >0 ? 'red' : ''}}"></i></a>
                            <form action="{{route('postlike',$post->id)}}" method="POST" style="display:none;" id="like-form-{{$post->id}}">
                                @csrf
                            </form>
                            @endauth
                        </div>
                        <div class="post-stats">
                            <p><i class="bi bi-eye-fill"></i> {{$post->view_count}}<span> // <i class="bi bi-heart-fill"></i> {{$post->likedUsers->count()}}</span> // <span><i class="bi bi-chat-dots-fill"></i> {{count($comments)}}</span></p>
                        </div>
                        <div class="post-meta">
                            <p>{{$post->user->name}} //</span><span> {{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y')}}</span></p>
                        </div>
                        <p class="post-content">
                            {!!$post->content!!}
                        </p>
                        <div class="post-tags mb-2">
                            <ul class="list-group list-group-horizontal list-unstyled d-flex flex-wrap">
                                @foreach($post->tags as $tag)
                                    <li class="ms-2 mb-2"><a href="{{ URL::to('/tag/' . $tag->slug) }}" class="btn btn-outline-secondary">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="social-share d-flex align-items-center justify-content-start">
                            <h3>Share: - </h3>
                            <ul class="list-group list-group-horizontal ms-2">
                                <li class="list-group-item"><a href="#"><i class="bi bi-facebook"></i></a></li>
                                <li class="list-group-item"><a href=""><i class="bi bi-twitter"></i></a></li>
                            </ul>
                        </div>
                        <!-- Comments Section -->
                        <section id="comments" class="comments mt-3">
                            <h3 class="comments-heading">
                                @if(count($comments)== 0)
                                    No Comments
                                @elseif(count($comments)==1)
                                    {{count($comments)}} Comment
                                @else
                                    {{count($comments)}} Comments
                                @endif
                            </h3>
                            @foreach($comments as $comment)
                            <ul class="comments-list list-group list-group-horizontal list-unstyled">
                                <li class="list-group-item">
                                    <img src="https://placehold.co/100x100" alt="" class="comments-avatar avatar avatar-64 bg-light rounded-circle text-white p-2">
                                </li>
                                <li class="list-group-item">
                                    <p>
                                        {{$comment->content}}
                                    </p>
                                    <p>By:- {{$comment->user->name}} On<span> || {{ $comment->updated_at->diffForHumans() }}</span></p>
                                </li>
                                @auth
                                <li class="list-group-item">
                                    <div class="dropdown">
                                        @if($comment->user->is(auth()->user()))
                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                        
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item text-warning" href="#" data-bs-toggle="modal" data-bs-target="#comment-edit-modal-{{$comment->id}}">Edit</a></li>
                                            <li>
                                                <form method="POST" action="{{ URL::to('/comment/delete/' . $comment->id) }}">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ URL::to('/comment/delete/' . $comment->id) }}" class="dropdown-item text-danger" onclick="event.preventDefault(); this.closest('form').submit();">Delete</a>
                                                </form>
                                            </li>
                                        </ul>
                                        @endif
                                    </div>
                                    <!-- Comment Update Modal -->
                                    <div class="modal fade" id="comment-edit-modal-{{$comment->id}}" tabindex="-1" aria-labelledby="comment-edit-modal-{{$comment->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="commentModalLabel">Update Comment</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="{{ route('commentupdate', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('patch')
                                                <div class="mb-3">
                                                    <textarea class="form-control" name="comment-message" id="comment-message" cols="30" rows="10">{{$comment->content}}</textarea>
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <input type="submit" class="btn btn-success" value="Update Comment">
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </li>
                                @endauth
                            </ul>
                            @endforeach
                            <div class="comment-entry-form mt-3">
                                @auth
                                    @if(Auth::user()->hasVerifiedEmail())
                                        <h5 class="comment-title">Leave a Comment</h5>
                                        <form method="post" action="{{ URL::to('/comment/post/' . $post->id) }}">
                                            @csrf
                                            <div class="mb-3">
                                                <textarea class="form-control" name="comment-message" id="comment-message" placeholder="Enter your message" cols="10" rows="3"></textarea>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <input type="submit" class="btn btn-success" value="Post comment">
                                            </div>
                                        </form>
                                    @else
                                        <h5 class="comment-title">Please <a href="#" data-bs-toggle="modal" data-bs-target="#verification-modal" style="color:red;">Verify your Email</a> to Leave a Comment</h5>
                                        <!-- Verification Modal -->
                                        <div class="modal fade" id="verification-modal" tabindex="-1" aria-labelledby="verification-modal" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="verificationModalLabel">Thanks for signing up!</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                                                    <form action="{{ route('verification.send') }}" method="POST">
                                                        @csrf
                                                        <div class="d-grid gap-2">
                                                            <input type="submit" class="btn btn-primary" value="Resend Verification Email">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <h5 class="comment-title">Please Login to Leave a Comment</h5>
                                @endauth
                            </div>
                        </section>
                    </div><!-- End Latest Post -->
                    <!-- Single Sidebar -->
                    <div class="sidebar col-md-4">
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
                        <!-- Post Tab Widget -->
                        <div id="post-tab" class="widget post-tab-widget border border-1 mt-2 p-2">
                            <ul class="nav nav-tabs bg-dark" id="postTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="trending-tab" data-bs-toggle="tab" data-bs-target="#trending-tab-pane" type="button" role="tab" aria-controls="trending-tab-pane" aria-selected="true">Trending</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="popular-tab" data-bs-toggle="tab" data-bs-target="#popular-tab-pane" type="button" role="tab" aria-controls="popular-tab-pane" aria-selected="false">Popular</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="latest-tab" data-bs-toggle="tab" data-bs-target="#latest-tab-pane" type="button" role="tab" aria-controls="latest-tab-pane" aria-selected="false">Latest</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="postTabContent">
                                <div class="tab-pane fade show active" id="trending-tab-pane" role="tabpanel" aria-labelledby="trending-tab" tabindex="0">
                                    <div class="trending-tab">
                                        @foreach($trendings as $trending)
                                        <ul class="mt-1 list-group list-unstyled">
                                            <li class="list-group-item">
                                                <h6><a href="{{ URL::to('/' . $trending->slug) }}">{{$trending->title}}</a></h6>
                                                <p class="mb-0"><small>{{$trending->user->name}}</small></p>
                                            </li>
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="popular-tab-pane" role="tabpanel" aria-labelledby="popular-tab" tabindex="0">
                                    <div class="popular-tab">
                                        @foreach($populars as $popular)
                                        <ul class="mt-1 list-group list-unstyled">
                                            <li class="list-group-item">
                                                <h6><a href="{{ URL::to('/' . $popular->slug) }}">{{$popular->title}}</a></h6>
                                                <p class="mb-0"><small>{{$popular->user->name}}</small></p>
                                            </li>
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="latest-tab-pane" role="tabpanel" aria-labelledby="latest-tab" tabindex="0">
                                    <div class="latest-tab">
                                        @foreach($latestposts as $lpost)
                                        <ul class="mt-1 list-group list-unstyled">
                                            <li class="list-group-item">
                                                <h6><a href="{{ URL::to('/' . $lpost->slug) }}">{{$lpost->title}}</a></h6>
                                                <p class="mb-0"><small>{{$lpost->user->name}}</small></p>
                                            </li>
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Post tab Widget -->
                        <!-- Categories Widget -->
                        <div class="widget categories-widget border border-1 p-2">
                            <h3 class="widget-heading text-decoration-underline text-center">Categories</h3>
                            <ul class="list-group list-group-unstyled">
                                @foreach($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">
                                            <i class="bi bi-arrow-right-circle-fill text-danger"></i>
                                            <a href="{{ URL::to('/category/' . $category->slug) }}" class="ps-2">
                                                {{$category->name}}
                                            </a>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{count($category->posts)}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div><!-- End Categories Widget -->
                        <!-- Tags Widget -->
                        <div class="widget tags-widget border border-1 p-2">
                            <h3 class="widget-heading text-decoration-underline text-center">Tags</h3>
                            <div class="tags-list">
                                <ul class="list-group list-group-horizontal list-unstyled d-flex flex-wrap">
                                    @foreach($tags as $tag)
                                        @if(($tag->published_posts_count > 0))
                                            <li class="ms-2 mb-2"><a href="{{ URL::to('/tag/' . $tag->slug) }}" class="btn btn-outline-secondary">{{$tag->name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- End Tags Widget -->
                    </div><!-- End Single Sidebar -->
                </div> <!-- End Row Inner Content -->
            </section><!-- End Inner Content -->
            <!-- Related Post -->
            <section id="category">
                <div class="row border-bottom mt-5">
                    <div class="col-md-12">
                        <div class="category-header">
                            <h2>You May Also Like(Related Posts)</h2>
                        </div>
                    </div>
                </div>
                <!-- Inner Related Posts-->
                <div class="row mt-5">
                    <div class="main-post col-md-3">
                        <div class="post-img">
                            <a href="#"><img src="https://placehold.co/600x400" alt="" class="img-fluid"></a>
                            <div class="overlay"></div>
                            <a href="#" class="post-like"><i class="bi bi-heart-fill"></i></a>
                        </div>
                        <div class="post-meta">
                            <p>Category<span> // Author //</span><span> // Date //</span></p>
                        </div>
                        <h3><a href="#">Title</a></h3>
                        <p>Content</p>
                        <div class="post-stats">
                            <p><i class="bi bi-eye-fill"></i> 0<span> // <i class="bi bi-heart-fill"></i> 0</span> // <span><i class="bi bi-chat-dots-fill"></i> 0</span></p>
                        </div>
                    </div>
                    <div class="main-post col-md-3">
                        <div class="post-img">
                            <a href="#"><img src="https://placehold.co/600x400" alt="" class="img-fluid"></a>
                            <div class="overlay"></div>
                            <a href="#" class="post-like"><i class="bi bi-heart-fill"></i></a>
                        </div>
                        <div class="post-meta">
                            <p>Category<span> // Author //</span><span> // Date //</span></p>
                        </div>
                        <h3><a href="#">Title</a></h3>
                        <p>Content</p>
                        <div class="post-stats">
                            <p><i class="bi bi-eye-fill"></i> 0<span> // <i class="bi bi-heart-fill"></i> 0</span> // <span><i class="bi bi-chat-dots-fill"></i> 0</span></p>
                        </div>
                    </div>
                    <div class="main-post col-md-3">
                        <div class="post-img">
                            <a href="#"><img src="https://placehold.co/600x400" alt="" class="img-fluid"></a>
                            <div class="overlay"></div>
                            <a href="#" class="post-like"><i class="bi bi-heart-fill"></i></a>
                        </div>
                        <div class="post-meta">
                            <p>Category<span> // Author //</span><span> // Date //</span></p>
                        </div>
                        <h3><a href="#">Title</a></h3>
                        <p>Content</p>
                        <div class="post-stats">
                            <p><i class="bi bi-eye-fill"></i> 0<span> // <i class="bi bi-heart-fill"></i> 0</span> // <span><i class="bi bi-chat-dots-fill"></i> 0</span></p>
                        </div>
                    </div>
                    <div class="main-post col-md-3">
                        <div class="post-img">
                            <a href="#"><img src="https://placehold.co/600x400" alt="" class="img-fluid"></a>
                            <div class="overlay"></div>
                            <a href="#" class="post-like"><i class="bi bi-heart-fill"></i></a>
                        </div>
                        <div class="post-meta">
                            <p>Category<span> // Author //</span><span> // Date //</span></p>
                        </div>
                        <h3><a href="#">Title</a></h3>
                        <p>Content</p>
                        <div class="post-stats">
                            <p><i class="bi bi-eye-fill"></i> 0<span> // <i class="bi bi-heart-fill"></i> 0</span> // <span><i class="bi bi-chat-dots-fill"></i> 0</span></p>
                        </div>
                    </div>
                </div><!-- End Inner Related Post-->
            </section><!-- Related Post -->
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