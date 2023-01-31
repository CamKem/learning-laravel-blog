<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    # The following represent the 7 restful controller actions

    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show', compact('comment'));
    }

    public function store(Post $post)
    {

        $attributes = request()->validate([
            'body' => 'required',
        ]);

        $post->comments()->create([
            'body' => $attributes['body'],
            'user_id' => request()->user()->id,
        ]);

        return back()->with('success', 'Comment created successfully');

    }

    public function edit($id)
    {

        # This is the edit form for a comment
        $comment = Comment::find($id);

        return view('comments.edit', compact('comment'));

    }

    public function update(Comment $comment)
    {

        $attributes = request()->validate([
            'body' => 'required',
        ]);

        $comment->update($attributes);

        return back()->with('success', 'Comment updated successfully');

    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('alert', 'Comment deleted successfully');
    }
}
