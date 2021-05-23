<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* Columns in the table Highscores
*
* @package App\Models
* @property string $username
* @property string $score
* @method static Builder orderBy(string $column, string $direction)
*/


class Highscores extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getHighscores()
    {
        $scores = [];
        /* @phpstan-ignore-next-line */
        foreach (Highscores::orderBy('score', 'DESC')->get() as $score) {
            array_push($scores, [
                'username' => $score->username,
                'score' => $score->score,
            ]);
        }

        return array_slice($scores, 0, 10);
    }
}
