<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dice\Bets;
use App\Models\Dice\Dice;
use App\Models\Dice\DiceHand;
use App\Models\Dice\StatsHistogram;
use App\Models\Users;

use App\Models\Stats;

class GameController extends Controller
{

    public function playGame()
    {
        $info = [];

        if (session("account")) {
            session(['user' => 0]);
            session(['computer' => 0]);
            session(['score' => 0]);
            session(['compScore' => 0]);
            session(['bet' => 0]);

            $user = new Users();
            $info = $user->getUserData(session("account"));
        }

        return view('game', [
          'message' => "Choose one or two dices to play with!",
          'user' => $info[0] ?? "def",
        ]);
    }

    public function startGame(Request $request)
    {
        $action = $request->input('action');
        $stats = new StatsHistogram();
        $message = "";
        $result = [];

        if ($action === "Start!") {
            session(['dices' => $request->input('dices')]);
            $message = "The goal is to score as close to 21 as possible.";
        } elseif ($action === "BET") {
            session(['bet' => (int)$request->input('bet')]);
        } elseif ($action === "Roll") {
            $hand = new DiceHand((int)session('dices'));
            $hand->roll();
            $result = $hand->result;
            $sum = $hand->sum;
        } elseif ($action === "New round") {
            session(['score' => 0]);
            session(['compScore' => 0]);
        } elseif ($action === "Stop") {
            $score = $request->input('score');
            $compScore = $this->roll();
            $new = 0;
            $bets = new Bets();
            $bets->amount = session('bet');

            if ($score > 21) {
                $new = $score - 21;
            }
            if ($score < 21) {
                $new = 21 - $score;
            }

            if (($score != 21 and $compScore == 21) || (($compScore - 21) < $new) || (($compScore - 21) == $new)) {
                $message = "The Computer won!";
                $current = session('computer');
                $current += 1;
                session(['computer' => $current]);
                $bets->update("lost");
                $stats->lost();
            } elseif (($score == 21) || (($compScore - 21) > $new)) {
                $message = "Congrats, you won!";
                $current = session('user');
                $current += 1;
                session(['user' => $current]);
                $bets->update("won");
                $stats->won($score);
            }
            session(['score' => 0]);
            session(['compScore' => 0]);
            session(['bet' => 0]);

            $sum = ("Computer score: "  . $compScore);
        } elseif ($action === "End game") {
            return redirect()->route('game');
        }

        $user = new Users();
        $info = $user->getUserData(session("account"));
        $allstats = $stats->getStats();

        return view('diceGame', [
            'message' => $message,
            'sum' => $sum ?? null,
            'result' => $result ?? null,
            'compScore' => $compScore ?? null,
            'user' => $info[0] ?? null,
            'stats' => $allstats ?? null
        ]);
    }

    public function roll(): int
    {
        $die = new Dice();
        $compScore = 0;

        while ($compScore < 21) {
            $die->roll();
            $compScore += $die->getLastRoll();
        }

        return $compScore;
    }
}
