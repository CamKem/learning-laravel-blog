<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back();
    }

    public function show(Post $post)
    {
        //with('author') for lazy loading to reduce db queries
        $comments = $post->comments()->with('author')->latest()->simplePaginate(5);
        return view('posts.show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function index()
    {
        flash('Welcome Aboard!');

        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);
    }

    protected function validatePost()
    {
        return request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'sometimes|file|image|max:5000'
        ]);
    }

    protected function storeImage($post)
    {
        if (request()->has('thumbnail')) {
            $post->update([
                'thumbnail' => request()->thumbnail->store('uploads', 'public')
            ]);
        }
    }

    protected function deleteImage($post)
    {
        if ($post->thumbnail) {
            Storage::delete('/public/' . $post->thumbnail);
        }
    }

    protected function storePost()
    {
        $post = Post::create($this->validatePost());
        $this->storeImage($post);
        return $post;
    }
}
