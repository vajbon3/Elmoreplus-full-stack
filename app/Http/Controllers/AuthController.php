<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|confirmed"
        ]);

        $user = User::create([
            "name" => $fields["name"],
            "email" => $fields["email"],
            "password" => bcrypt($fields["password"])
        ]);

        $response = [
            "user" => $user,
        ];

        return response($response, 201)->redirectTo("/");
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect("/");
    }

    public function login(Request $request) {
        $fields = $request->validate([
           "email" => "required|email",
           "password" => "required|string",
            "remember" => "boolean"
        ]);

        // check email
        $user = User::where("email", $fields["email"])->first();

        if(Auth::attempt($request->all(["email", "password"]),$request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended("/");
        } else {
            Session::flash("error", "bad credentials");
            return back()->withInput($request->except("password"));
        }
    }
}
