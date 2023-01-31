<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|[
*/

Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/posts/{post:slug}', 'show')->name('post.view');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('posts/comment/create', 'store')->name('comment.create');
});

Route::controller(RegisterController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store')->name('register');
    });

Route::controller(SessionController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store')->name('login');
    })
    ->middleware('auth')
    ->group(function () {
        Route::post('logout', 'destroy')->name('logout');
    });

//Route::controller(PostController::class)
//    ->prefix('/articles')
//    ->name('articles.')
//    ->group(function () {
//        Route::get('/', 'index')->name('index');
//        Route::get('/{article:slug}', 'show')->name('show');
//        Route::get('/create')->name('create');
//        Route::post('/', 'store')->name('store');
//        Route::delete('/destroy', 'destroy')->name('destroy');
//        Route::put('/edit', 'update')->name('update');
//    });

//Route::get('category/{category:slug}', function (Category $category) {
//    return view('posts', [
//        'firstpost' => $category->posts()->latest()->first(),
//        'posts' => $category->posts()->latest()->skip(1)->paginate(6),
//        //below uses the load method to eager load the relationships to reduce db queries
//        //$category->posts->load('category', 'comments', 'user')->paginate(10),
//        //below uses the without method to in a single instance to reduce db queries
//        //$category->posts()->without('category', 'comments', 'user')->paginate(10),
//        //'categories' => Category::all(),
//        'currentCategory' => $category
//    ]);
//})->name('category');
