<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        Comment::create($attributes);

        session()->flash('alert', 'This is an alert message!');

        return back()->with('success', 'Comment created successfully');
    }
}
