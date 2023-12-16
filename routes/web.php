<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::controller(HomeController::class)->group(function(){

    Route::get('/', 'index')->name('home');
    Route::get('/{post:slug}', 'show')->name('view');
    Route::post('comment/post/{id}', 'savecomment')->name('commentsave');
    Route::delete('comment/delete/{id}', 'deletecomment')->name('commentdelete');
    Route::patch('comment/update/{id}', 'updatecomment')->name('commentupdate');
    Route::post('like-post/{post}', 'likePost')->middleware(['auth', 'verified'])->name('postlike');
    Route::get('/category/{slug}', 'scategory')->name('singlecategory');
    Route::get('/tag/{slug}', 'stag')->name('singletag');

});

Route::get('/pages/about-us', function () {
    $cap = \App\Models\Textinfo::where('key','page-about-us')->count();
    if($cap>0){
        $aboutpage = \App\Models\Textinfo::where('key','page-about-us')->firstorfail();
        return view('about', compact('aboutpage'));
    }
    else{
        return redirect()->route('home');
    }
});

/*Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

require __DIR__.'/auth.php';
