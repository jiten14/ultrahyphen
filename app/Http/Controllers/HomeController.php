<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $singlepost = Post::where('is_published', 1)->latest()->first();
        if(isset($singlepost)){
            $featureds = Post::where('is_published', 1)->where('is_featured',1)->with('user', 'category')->get();
            $posts = Post::where('is_published', 1)->with('user', 'category')
            ->withCount([
                'comments',
                'comments as comments_count' => function (Builder $query) {
                    $query->where('is_visible', 1);
                }
            ])->latest()->paginate(9);

            $trendings = Post::where('is_published', 1)->with('user')->orderByDesc('view_count')->take(5)->get();

            $categories = Category::withWhereHas('posts', function ($query) {
                $query->where('is_published', true);
            })->take(3)->get();

            return view('welcome', compact('featureds','posts','categories', 'trendings'));
        }
        else{
            return '<h1>Add Few Posts</h1>';
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $spost = Post::where('slug', $slug)->firstOrFail();
        $id = $spost->id;
        $post = Post::with('category','user')->find($id);
        
        $comments = Post::find($id)->comments()
                    ->where('is_visible', '1')
                    ->with('user')
                    ->get();
        
        $postKey = 'post_'.$post->id;
        if(!Session::has($postKey)){
            $post->increment('view_count');
            Session::put($postKey,1);
        }

        $categories = Category::withWhereHas('posts', function ($query) {
            $query->where('is_published', true);
        })->get();

        $trendings = Post::where('is_published', 1)->with('user', 'category')->orderByDesc('view_count')->take(5)->get();
        
        $latestposts = Post::where('is_published', 1)->with('user', 'category')->latest()->take(5)->get();

        $tags = Tag::withCount([
            'posts',
            'posts as published_posts_count' => function (Builder $query) {
                $query->where('is_published', true);
            },
        ])->get();

        $populars = Post::where('is_published', 1)->withCount('likedUsers')->orderByDesc('liked_users_count')->with('category','user')->take(5)->get();

        return view('post', compact('post','comments','trendings','categories','latestposts', 'tags', 'populars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function savecomment(Request $request, string $id)
    {
        $comment = new comment;
            $comment->user_id       = Auth::user()->id;
            $comment->post_id      = $id;
            $comment->content = $request->input('comment-message');
            $comment->is_visible      = 0;
            $comment->save();
        return back()->with('status', 'Comment posted.It is under Review.');
    }

    public function deletecomment(Request $request, string $id)
    {
        Comment::where('id', $id)->delete();
        return back()->with('status', 'Comment Deleted!.');
    }

    public function updatecomment(Request $request, string $id)
    {
        Comment::find($id)->update([
            'content' => request('comment-message'),
        ]);
        return back()->with('status', 'Comment Updated!.');
    }
    
    public function likePost(Request $request, string $post)
    {
        $user = Auth::user();
        $likePost = $user->likedPosts()->where('post_id',$post)->count();
        if($likePost == 0){
            $user->likedPosts()->attach($post);
        } else {
            $user->likedPosts()->detach($post);
        }
        return back()->with('status', 'Your Preference saved!');
    }
}
