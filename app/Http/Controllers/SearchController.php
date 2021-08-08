<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = request("query");
        $notifications = Notification::where("to",Auth()->id())->take(5)->orderBy("created_at", "DESC")->get();
        $users = User::where("name","like","%".$query."%")->get();

        return view("search",[
            "users" => $users,
            "notifications" => $notifications,
        ]);
    }
}
