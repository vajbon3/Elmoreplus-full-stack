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


// protected routes
Route::group(["middleware" => ["auth"]], function() {
    // Post
    Route::post("/posts",[PostController::class, "create"])->name("api.posts.create");
    Route::get("/posts", [PostController::class, "read"])->name("api.posts");
    Route::put("/posts/{post_id}", [PostController::class, "update"])->name("api.posts.update");
    Route::delete("/posts/{post_id}", [PostController::class, "delete"])->name("api.posts.delete");

    // Comment
    Route::post("/comments", [CommentController::class, "create"])->name("api.comments.create");
    Route::get("/posts/{post_id}/comments", [CommentController::class, "read"])->name("api.comments");
    Route::put("/comments/{comment_id}", [CommentController::class, "update"])->name("api.comments.update");
    Route::delete("/comments/{comment_id}", [CommentController::class, "delete"])->name("api.comments.delete");

    // like
    Route::post("/posts/{post_id}/like", [LikeController::class, "create"])->name("api.likes.create");
    Route::get("/posts/{post_id}/likes", [LikeController::class, "read"])->name("api.likes");
    Route::delete("/posts/{post_id}/like", [LikeController::class, "delete"])->name("api.likes.delete");

    // friend requests
    Route::post("/requests", [\App\Http\Controllers\RequestController::class, "create"])->name("api.requests.create");
    Route::post("/requests/confirm", [\App\Http\Controllers\RequestController::class, "confirm"])->name("api.requests.confirm");

    // notifications
    Route::post("/notifications", [\App\Http\Controllers\NotificationController::class, "read"])->name(("api.notifications.read"));
    Route::post("/notifications/requests", [\App\Http\Controllers\NotificationController::class, "getRequests"])->name(("api.notifications.requests"));
    Route::post("/notifications/delete", [\App\Http\Controllers\NotificationController::class, "delete"])->name(("api.notifications.delete"));

});
