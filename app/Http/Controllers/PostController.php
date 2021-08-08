<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(Request $request) {
        // validate input
        $post = $request->validate([
            "body" => "required|string|max:800"
        ]);

        // create the post
        $post = Post::create([
            "user_id" => auth()->id(),
            "body" => $post["body"]
        ]);

        $post->load("author");
        return response($post,201);
    }

    public function read() {
        return Post::where("user_id", auth()->user()->id)->orderBy("created_at","DESC")->get();
    }

    public function update(Request $request, $post_id) {
        // validate input
        $validated = $request->validate([
            "body" => "required|string|max:800",
        ]);

        // find the right post
        $post = Post::where("id", $post_id)->first();
        if(!$post)
            return response("No such post exists",404);

        // update the post
        $post->update([
            "body" => $validated["body"]
        ]);

        return response($post,201);
    }

    public function delete($post_id) {
        // find the right post
        $post = Post::where("id", $post_id)->first();
        if(!$post)
            return response("No such post exists",404);

        // delete the post
        $post->delete();

        return response("Post deleted",201);
    }
}
