<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Highscores;
use App\Models\Users;

class HighscoreController extends Controller
{
    public function view()
    {
        $hsDb = new Highscores();
        $uDb = new Users();

        $scores = $hsDb->getHighscores();
        $users = $uDb->getTopTen();


        return view('highscores', [
            'title' => "Highscores",
            'scores' => $scores,
            'users' => $users
        ]);
    }

    public function saveHighscore(Request $request)
    {
        $hsDb = new Highscores();

        $hsDb->username = session('account');
        $hsDb->score = $request->input('score');
        $hsDb->save();

        return redirect()->route('highscores');
    }
}
