<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
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
        //
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
}
