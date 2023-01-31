<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
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

Route::post('newsletter', NewsletterController::class)->name('newsletter');

Route::controller(PostController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/posts/{post:slug}', 'show')->name('post.view');
    });

Route::controller(PostLikeController::class)
    ->middleware('auth')
    ->group(function () {
        Route::post('posts/{post}/like', 'store')->name('post.like.store');
        Route::delete('posts/{post}/like', 'destroy')->name('post.like.destroy');
    });

Route::controller(AdminPostController::class)
    ->middleware('can:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/posts', 'index')->name('post.dashboard');
        Route::get('/posts/create', 'create')->name('post.create');
        Route::post('/posts', 'store')->name('post.store');
        Route::get('/posts/{post}/edit', 'edit')->name('post.edit');
        Route::patch('/posts/{post}', 'update')->name('post.update');
        Route::delete('/posts/{post}', 'destroy')->name('post.destroy');
    });



//Add the logic for the routes below
Route::middleware(['admin', 'auth'])->group(function () {
    Route::resource('admin/categories', AdminCategoryController::class)
        ->except('show')
        ->names('admin.categories');
});

// gamify the app https://github.com/qcod/laravel-gamify

//Add delete confirmation dialog aplinejs component to the post delete admin.

//Create a user profile page that displays all posts that the user has liked. (You can use the PostLikeController to get the posts that the user has liked)

//Gamify the app by adding points to users for certain actions.

//Update the "Edit Post" page in the admin section to allow for changing the author of a post.
//Add an RSS feed that lists all posts in chronological order.
//Allow registered users to "follow" certain authors. When they publish a new post, an email should be delivered to all followers.
//Allow registered users to "bookmark" certain posts that they enjoyed. Then display their bookmarks in a corresponding settings page.
//Add an account page to update your username and upload an avatar for your profile.


Route::controller(CommentController::class)
    ->middleware('auth')
    ->group(function () {
        Route::post('posts/{post:slug}/comment', 'store')->name('comment.create');
        Route::delete('posts/comments/{comment}/delete', 'destroy')->name('comment.destroy');
    });

Route::controller(CommentLikesController::class)
    ->middleware('auth')
    ->group(function () {
        Route::post('posts/comments/{comment}/like', 'store')->name('comment.like.store');
        Route::delete('posts/comments/{comment}/like', 'destroy')->name('comment.like.destroy');
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
