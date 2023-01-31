<?php

namespace App\Http\Controllers;

use App\Gamify\Points\PostCreated;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{

    public function index()
    {

        return view('admin.post.index', [
            'posts' => Post::latest()->paginate(20)
        ]);

    }

    public function create()
    {
        return view('admin.post.create', [
            'post' => new Post(),
            'categories' => Category::all()
        ]);

    }

    public function store()
    {

        $attributes = $this->validatePost(new Post);

        if (request('published') == null) {
            $attributes['published'] = false;
        } else {
            $attributes['published'] = (bool)request('published');
        }

        $attributes['user_id'] = auth()->id();

        $attributes['thumbnail'] = request('thumbnail')->store('thumbnails');

        //FROM HERE WE CAN USE REPUTATION SYSTEM

        $user = request()->user();
        $post = Post::create($attributes);

        // you can use helper function
        //givePoint(new PostCreated($post));
        // or via HasReputation trait method
        givePoint(new PostCreated($user));

        //TO HERE WE CAN USE REPUTATION SYSTEM

        //Post::create($attributes);

        return redirect()->route('admin.post.dashboard')->with('success', 'Post created successfully.');

    }

    public function edit(Post $post)
    {
        return view('admin.post.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }


    public function update(Post $post)
    {

        $attributes = $this->validatePost($post);

        if (request('published') == null) {
            $attributes['published'] = false;
        } else {
            $attributes['published'] = (bool)request('published');
        }

        if (request('thumbnail')) {
            $attributes['thumbnail'] = request('thumbnail')->store('thumbnails');
            Storage::delete($post->thumbnail);
            //ddd($delete);
        }

        $post->update($attributes);

        return back()->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete($post->thumbnail);
        $post->delete();

        return redirect()->back()->with('error', 'Post deleted successfully.');
    }

    // Additional methods (non-restful)

    // validatePost() is a helper method that is used by both store() and update()
    // validates the request and returns the validated attributes
    public function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists() ? ['image'] : ['required', 'image'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }

}
