<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Models\Users;

class LoginController extends Controller
{
    public function view()
    {
        return view('login', [
            'title' => "Login",
            'msg' => "hej"
        ]);
    }

    public function handle(Request $request)
    {
        $user = new Users;
        $action = $request->input('action');

        if ($action === "login") {
            $val = $user->checkUser([
                $request->input('username'),
                $request->input('password')
            ]);

            if ($val === true) {
                session(['account' => $request->input('username')]);
                return back()->withErrors([
                  'message' => "Hej"
                ]);
            }
            if ($val === false) {
                return back()->withErrors([
                  'message' => "Nej"
                ]);
            }

        } elseif ($action === "reg") {

            if ($user->checkUsername($request->input('username')) === false) {
                return back()->withErrors([
                    'message' => "Username is already taken"
                ]);
            }

            if ($request->input('password') !== $request->input('confirm')) {
                return back()->withErrors([
                    'message' => "Your passwords don't match"
                ]);
            }

            $user->username = $request->input('username');
            $user->password = $request->input('password');
            $user->coins = 10;
            $user->save();

            return redirect()->route('highscores');
        }
    }
}
