<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Stats;
use App\Models\Dice\StatsHistogram;

class HelloWorldController extends Controller
{
    public function hello($message = null)
    {
        $s = new Stats();
        // $sh = new StatsHistogram();
        // $messaget = $sh->won(21);
        // $s->updateStats($messaget);
        $message = $s->getUserData();


        return view('message', [
          'message' => $message ?? "Hello World!",
          'messaget' => $messaget ?? "Hello World!"
        ]);
    }
}
