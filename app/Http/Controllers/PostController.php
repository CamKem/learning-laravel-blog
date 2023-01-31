<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{

    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()
                ->withExists([
                    'like' => function($query) {
                        $query->where('user_id', auth()->id());
                    }
                ])
                ->where('published', true)
                ->filter(request(['search', 'category', 'author']))
                ->paginate(6)
                ->withQueryString(),
            'categories' => Category::all(),
        ]);
    }

     //   return view('posts.index', [
     ////       'posts' => Post::latest()
     //           ->where('published', true)
    //            ->filter(request(['search', 'category', 'author']))
    //            ->paginate(6)
     //           ->withQueryString()
    //            ->withExists(['likes' => function ($query) {
    //                $query->where('user_id', auth()->id());
    //            }]),
    //        'categories' => Category::all(),
    //    ]);
    //}

    public function show(Post $post)
    {
        //increment the view count
        $post->increment('views');

        $post->loadExists([
            'like' => function($query) {
                $query->where('user_id', auth()->id());
            }
        ]);
        return view('posts.show', [
            'post' => $post,
            'comments' => $post->comments()->with('author')->simplePaginate(5)
        ]);
    }

}
