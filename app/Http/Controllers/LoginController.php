<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Stats;

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
        $user = new Users();
        $action = $request->input('action');

        if ($action === "login") {
            $val = $user->checkUser([
                $request->input('username'),
                $request->input('password')
            ]);

            if ($val === true) {
                session(['account' => $request->input('username')]);
                return redirect()->route('game');
            }
            if ($val === false) {
                return back()->withErrors([
                  'message' => "The username or password is wrong."
                ]);
            }
        } elseif ($action === "reg") {
            if ($user->checkUsername($request->input('username')) === false) {
                return back()->withErrors([
                    'message' => "This username is already taken."
                ]);
            }

            if ($request->input('password') !== $request->input('confirm')) {
                return back()->withErrors([
                    'message' => "The password does not match."
                ]);
            }

            $user->username = $request->input('username');
            $user->password = $request->input('password');
            /* @phpstan-ignore-next-line */
            $user->coins = '10';
            $user->save();

            $stats = new Stats();
            $stats->username = $request->input('username');
            $stats->played = '0';
            $stats->won = '0';
            $stats->tweone = '0';
            $stats->save();


            return back()->withErrors([
                'message' => "You are now a member! Login to start playing."
            ]);
        } elseif ($action === "Logout") {
            $request->session()->flush();
            return redirect()->route('login');
        }
    }
}
