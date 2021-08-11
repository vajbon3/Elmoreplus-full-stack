<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// public routes
Route::middleware("auth")->group(function() {
    Route::get('/', function () {
        $posts = Auth()->user()->feed()->take(10);
        $notifications = Auth()->user()->notifications()->take(5)->orderBy("created_at", "DESC")->get();
        return view('home',[
            "posts" => $posts,
            "notifications" => $notifications
        ]);
    })->name("home");

    // friend requests
    Route::get("/requests", function() {
        $requests = Auth()->user()->requests()->take(10)->orderBy("created_at","DESC")->get();
        $notifications = Auth()->user()->notifications()->take(5)->orderBy("created_at", "DESC")->get();
        return view("requests", [
           "requests" => $requests,
           "notifications" => $notifications,
        ]);
    });

    // notifications
    Route::get("/notifications", function() {
        $notifications = Auth()->user()->notifications()->take(5)->orderBy("created_at", "DESC")->get();
        return view("notifications", [
            "notifications" => $notifications,
        ]);
    });

    // search
    Route::get("/search", [SearchController::class, "index"])->name("search");
});

Route::get("/login", function() {
    return view("login");
})->name("login");

Route::post("/register", [AuthController::class,"register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");




