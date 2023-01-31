<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;

class PostLikeController extends Controller
{

    public function store($post_id)
    {
        // check if the post has been liked by the user
        if(Post::find($post_id)->like()->where('user_id',  auth()->id())->exists()) {
                // if the post has already been liked return with an alert
                return back()->with('alert', 'Post already liked');
        } else {
            // if the post has not been liked, create a new model
            $post_like = new PostLike;
            // set the post_id and user_id
            $post_like->post_id = $post_id;
            $post_like->user_id = auth()->user()->id;
            // save the model
            $post_like->save();

            // return back with success message
            return back()->with('success', 'Post liked successfully');
        }
    }

    public function destroy($post_id)
    {

        // check if the post has been liked by the user
        if (Post::find($post_id)->like()->where('user_id',  auth()->id())->doesntExist()) {
            return back()->with('alert', 'Post not liked');
        } else {
            // find the model where post_id and user_id match
            $postLike = PostLike::where('post_id', $post_id)->where('user_id', auth()->user()->id)->first();

            // delete the model
            $postLike->delete();

            // return back with success message
            return back()->with('success', 'Post unliked successfully');
        }
    }
}
