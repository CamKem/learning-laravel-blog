<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentLikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($comment_id)
    {

        if (Comment::find($comment_id)->likes()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('alert', 'You already liked this comment');
        } else {
            $commentLike = new CommentLike();
            $commentLike->comment_id = $comment_id;
            $commentLike->user_id = auth()->user()->id;
            $commentLike->save();

            return redirect()->back()->with('success', 'Comment liked successfully');
        }

    }

    public function destroy($comment_id)
    {

        if (Comment::find($comment_id)->likes()->where('user_id', auth()->id())->doesntExist()) {
            return redirect()->back()->with('alert', 'You have not liked this comment');
        } else {
            $commentLike = CommentLike::where('comment_id', $comment_id)->where('user_id', auth()->user()->id)->first();
            $commentLike->delete();

            return redirect()->back()->with('success', 'Comment unliked successfully');
        }

    }
}
