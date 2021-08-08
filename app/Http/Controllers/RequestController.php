<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Notification;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create(Request $request) {
        // validate
        $validated = $request->validate([
            "id" => "required|exists:users,id"
        ]);

        // create a friendship request notification
        $notification = Notification::create([
                "to" => $request->id,
                "subject" => Auth()->id(),
                "type" => 1,
                "url" => "/requests"
        ]);

        return response($notification,201);
    }

    public function confirm(Request $request) {
        $validated = $request->validate([
           "id" => "required|exists:notifications,id"
        ]);

        $notification = Notification::where("id",$request->id)->first();

        if($notification->to != Auth()->id())
            return response("not yours to confirm",401);

        // create a friendship
        Friendship::create([
            "A" => $notification->subject,
            "B" => $notification->to,
        ]);

        Friendship::create([
           "A" => $notification->to,
           "B" => $notification->subject
        ]);

        // delete the notification
        $notification->delete();

        return response("confirmed", 201);
    }

}
