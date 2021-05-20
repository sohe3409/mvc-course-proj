<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class HelloWorldController extends Controller
{
    public function hello($message = null)
    {
        return view('message', [
          'message' => $message ?? "Hello World!"
        ]);
    }
}
