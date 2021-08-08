<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    // add a friendship between users
    public function create(Request $request) {
        $validated = $request->validate([
           "id" => "required|exists:users,id"
        ]);

        $to = User::where("id",$validated->id)->first();

        Friendship::create([
            "A" => Auth()->id(),
            "B" => $to->id
        ]);

        Friendship::create([
           "A" => $to->id,
           "B" => Auth()->id(),
        ]);

        return response("success",201);
    }

    // get all friends for a user
    public function read(Request $request) {
        $friends = Friendship::where("A",Auth()->id())->get();

        return response($friends,201);
    }

    // delete the friendship
    public function delete(Request $request) {
        $validated = $request->validate([
           "id" => "required|exists:users,id"
        ]);

        $friendship = Friendship::where("A", $validated->id)->andWhere("B", Auth()->id())->first();

        $friendship->delete();

        $friendship = Friendship::where("B", $validated->id)->andWhere("A", Auth()->id())->first();

        $friendship->delete();

        return response("deleted", 201);
    }
}
