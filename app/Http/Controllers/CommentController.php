<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request) {
        // validate
        $request->validate([
            "post_id" => "required|exists:posts,id",
            "comment_body" => "required|max:500"
        ]);

        // create comment
        $comment = Comment::create([
            "post_id" => $request->post_id,
            "body" => $request->comment_body,
            "user_id" => Auth()->id(),
        ]);

        $comment->load(["author"]);

        return response($comment,201);
    }

    public function read(Request $request, $post_id) {
        $post = Post::where("id", $post_id)->first();

        if(!$post)
            return response("No such comment",404);

        $comments = $post->comments()->orderBy("created_at")->get();
        $comments->load(["author"]);

        return response($comments, 201);
    }

    public function update(Request $request, $comment_id) {
        // validate the text
        $validated = $request->validate([
            "body" => "required|string|max:500"
        ]);

        // find the right comment
        $comment = Comment::where("id", $comment_id);
        if(!$comment)
            return response("No such comment exists",404);

        // update the comment
        $comment->update([
           "body" => $validated["body"]
        ]);
        $comment->load(["author"]);

        return response($comment,201);
    }

    public function delete($comment_id) {
        // find the right comment
        $comment = Comment::where("id", $comment_id);
        if(!$comment)
            return response("Such comment does not exist",404);

        // delete the comment
        $comment->delete();

        return response("Comment deleted", 201);
    }
}
