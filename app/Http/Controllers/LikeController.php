<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function create($post_id) {
        // check if such post exists
        $post = Post::where("id",$post_id)->first();
        if(!$post)
            return response("Such post does not exist",404);

        // check if user has already liked the post
        $like = $post->likes()->where("user_id", Auth::user()->id);
        if($like)
            return response("User has already liked this post",409);

        // create a like
        $like = new Like([
            "post_id" => $post_id,
            "user_id" => Auth::user()->id,
        ]);

        // save it to database
        $like->save();

        return response($like, 201);
    }

    public function read($post_id) {
        // check if such post exists
        $post = Post::where("id",$post_id)->first();
        if(!$post)
            return response("Such post does not exist",404);

        // return like count from the eloquent relationship
        return response($post->likes()->count(),201);
    }

    public function delete($post_id) {
        // check if such post exists
        $post = Post::where("id",$post_id)->first();
        if(!$post)
            return response("Such post does not exist",404);

        // check if user has already liked the post
        $like = $post->likes()->where("user_id", Auth::user()->id);
        if(!$like)
            return response("User has not liked this post",409);

        // delete the like
        $like->delete();

        return response($like,201);
    }
}
