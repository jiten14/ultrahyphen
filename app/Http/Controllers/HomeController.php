<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
            $posts = Post::where('is_published', 1)->with('user', 'category')->latest()->paginate(9);

            $categories = Category::withWhereHas('posts', function ($query) {
                $query->where('is_published', true);
            })->take(3)->get();

            return view('welcome', compact('featureds','posts','categories'));
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
    public function show(string $id)
    {
        $post = Post::with('category','user')->find($id);
        $comments = Post::find($id)->comments()
                    ->where('is_visible', '1')
                    ->with('user')
                    ->get();

        return view('post', compact('post', 'comments'));
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
}
