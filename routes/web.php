<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $singlepost = Post::where('is_published', 1)->latest()->first();
    $navs = Category::withCount([
        'posts',
        'posts as published_posts_count' => function (Builder $query) {
            $query->where('is_published', true);
        },
    ])->latest()->take(10)->get();
    $featured = Post::where('is_published', 1)->where('is_featured',1)->with('user', 'category')->latest()->first();
    $posts = Post::where('is_published', 1)->with('user', 'category')->latest()->paginate(10);
    $tags = Tag::withCount([
        'posts',
        'posts as published_posts_count' => function (Builder $query) {
            $query->where('is_published', true);
        },
    ])->get();
    $authors = User::withCount([
        'posts',
        'posts as published_posts_count' => function (Builder $query) {
            $query->where('is_published', true);
        },
    ])->get();
    $comments = Comment::where('is_visible', 1)->withCount([
        'post',
        'post as published_post_count' => function (Builder $query) {
            $query->where('is_published', true);
        },'user'
    ])->latest()->get();
    $categories = Category::withCount([
        'posts',
        'posts as published_posts_count' => function (Builder $query) {
            $query->where('is_published', true);
        },
    ])->latest()->get();
    
    return view('welcome', compact('singlepost','navs','featured','posts','categories', 'comments', 'authors', 'tags'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
