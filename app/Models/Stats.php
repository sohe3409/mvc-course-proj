<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* Columns in the table Books
*
* @property string $username
* @property string $won
* @property string $played
* @property string $tweone
*/
class Stats extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getAllStats()
    {
        $users = [];

        foreach (Stats::all() as $user) {
            array_push($users, [
                'username' => $user->username,
                'played' => $user->played,
                'won' => $user->won,
                'tweone' => $user->tweone,
                'lol' => session('account')
            ]);
        }

        return $users;
    }

    public function getUserData()
    {
        $stats = [];

        foreach (Stats::all() as $user) {
            if ($user['username'] === session('account')) {
                $stats = [
                    'username' => $user->username,
                    'played' => $user->played,
                    'won' => $user->won,
                    'tweone' => $user->tweone
                ];
            }
        }

        return $stats;
    }

    public function updateStats($new)
    {
        Stats::where('username', session('account'))->update(array('played' => strval($new['played'])));
        Stats::where('username', session('account'))->update(array('won' => strval($new['won'])));
        Stats::where('username', session('account'))->update(array('tweone' => strval($new['tweone'])));
    }
}
