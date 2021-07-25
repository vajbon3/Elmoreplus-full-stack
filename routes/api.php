<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// public routes
Route::post("/register", [AuthController::class,"register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");


// protected routes
Route::group(["middleware" => ["auth:sanctum"]], function() {
    // Auth
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");

    // Post
    Route::post("/posts",[PostController::class, "create"])->name("posts.create");
    Route::get("/posts", [PostController::class, "read"])->name("posts");
    Route::put("/posts/{post_id}", [PostController::class, "update"])->name("posts.update");
    Route::delete("/posts/{post_id}", [PostController::class, "delete"])->name("posts.delete");

    // Comment
    Route::post("/comments", [CommentController::class, "create"])->name("comments.create");
    Route::get("/posts/{post_id}/comments", [CommentController::class, "read"])->name("comments");
    Route::put("/comments/{comment_id}", [CommentController::class, "update"])->name("comments.update");
    Route::delete("/comments/{comment_id}", [CommentController::class, "delete"])->name("comments.delete");

    // like
    Route::post("/posts/{post_id}/like", [LikeController::class, "create"])->name("likes.create");
    Route::get("/posts/{post_id}/likes", [LikeController::class, "read"])->name("likes");
    Route::delete("/posts/{post_id}/like", [LikeController::class, "delete"])->name("likes.delete");

});
