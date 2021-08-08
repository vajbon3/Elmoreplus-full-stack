<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // get all notifications
    public function read(Request $request) {
        $validate = $request->validate([
           "offset" => "required|exists:notifications,id"
        ]);

        $notifications = Notification::where("to", Auth()->id())->skip($request->offset -1)->take(5)->orderBy("created_at","DESC")->get();

        return response($notifications,201);
    }

    // get only friendship request notifications
    public function getRequests(Request $request) {
        $validate = $request->validate([
            "offset" => "required|exists:notifications,id"
        ]);

        $notifications = Notification::where("to", Auth()->id())->andWhere("type",1)->skip($request->offset -1)->take(5)->orderBy("created_at","DESC")->get();

        return response($notifications,201);
    }

    // delete a notification
    public function delete(Request $request) {
        $validated = $request->validate([
            "id" => "required|exists:notifications,id"
        ]);

        $notification = Notification::where("id",$validated->id)->first();

        if($notification->to != Auth()->id())
            return response("not your notification",401);

        $notification->delete();

        return response("deleted", 201);
    }
}
