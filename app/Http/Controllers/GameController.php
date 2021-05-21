<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dice\Dice;
use App\Models\Dice\DiceHand;
use App\Models\Dice\GraphicalDice;

class GameController extends Controller
{

    public function playGame(Request $request)
    {
        if (session("account")) {
          session(['user' => 0]);
          session(['computer' => 0]);
          session(['score' => 0]);
          session(['compScore' => 0]);
        }

        return view('game', [
          'message' => "Choose one or two dices to play with!"
        ]);
    }

    public function startGame(Request $request)
    {
        $action = $request->input('action');
        $message = "";
        $result = [];

        if ($action === "Start!") {
            session(['dices' => $request->input('dices')]);
            $hand = new DiceHand((int)session('dices'));
            $hand->roll();
            $result = $hand->result;
            $sum = $hand->sum;
        } elseif ($action === "Roll again") {
            $hand = new DiceHand((int)session('dices'));
            $hand->roll();
            $result = $hand->result;
            $sum = $hand->sum;
        } elseif ($action === "New round") {
            session(['score' => 0]);
            session(['compScore' => 0]);
            $hand = new DiceHand((int)session('dices'));
            $hand->roll();
            $result = $hand->result;
            $sum = $hand->sum;
        } elseif ($action === "Stop") {
            $score = $request->input('score');
            $compScore = $this->roll();
            $new = 0;

            if ($score > 21) {
                $new = $score - 21;
            }
            if ($score < 21) {
                $new = 21 - $score;
            }

            if (($score != 21 and $compScore == 21) or (($compScore - 21) < $new)) {
                $message = "The Computer won!";
                $current = session('computer');
                $current += 1;
                session(['computer' => $current]);
            } else {
                $message = "Congratulations, you won!";
                $current = session('user');
                $current += 1;
                session(['user' => $current]);
            }

            $sum = ("Computer score: "  . $compScore);
        } elseif ($action === "End game" || $action === "Logout") {
            $request->session()->flush();
            return view('message', [
                'message' => "Game ended!",
            ]);
        }

        return view('diceGame', [
            'message' => $message,
            'sum' => $sum ?? "def",
            'result' => $result ?? "def",
            'compScore' => $compScore ?? "def"
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
