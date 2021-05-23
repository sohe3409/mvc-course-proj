<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HighscoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/hello', [HelloWorldController::class, 'hello'])->name('hello');

Route::get('/game', [GameController::class, 'playGame'])->name('game');
Route::post('/game', [GameController::class, 'startGame']);

Route::get('/highscores', [HighscoreController::class, 'view'])->name('highscores');
Route::post('/highscores', [HighscoreController::class, 'saveHighscore']);

Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login', [LoginController::class, 'handle']);
