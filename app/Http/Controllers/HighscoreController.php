<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Highscores;

class HighscoreController extends Controller
{
    public function view()
    {
        $hsDb = new Highscores();

        $scores = $hsDb->getHighscores();

        return view('highscores', [
            'title' => "Highscores",
            'scores' => $scores
        ]);
    }

    public function saveHighscore(Request $request)
    {
        $hsDb = new Highscores();

        $hsDb->username = $request->input('username');
        $hsDb->coins = $request->input('coins');
        $hsDb->save();

        return redirect()->route('highscores');
    }
}