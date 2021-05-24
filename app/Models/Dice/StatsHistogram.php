<?php

namespace App\Models\Dice;
use App\Models\Stats;

/**
 * A dice which has the ability to show a histogram.
 */
class StatsHistogram extends Dice
{
    use HistogramTrait;


    public function won($score): void
    {
        $object = new Stats();
        $stats = $object->getUserData();
        $result = [];

        $result['played'] = (int)$stats['played'] + 1;
        $result["won"] = (int)$stats['won'] + 1;
        if ($score == 21) {
            $result["tweone"] = (int)$stats['tweone'] + 1;
        } else {
            $result["tweone"] = $stats['tweone'];
        }
        $object->updateStats($result);
    }

    public function lost(): void
    {
        $object = new Stats();
        $stats = $object->getUserData();
        $result = [
            'played' => ((int)$stats['played'] + 1),
            "won" => $stats['won'],
            "tweone" => $stats['tweone']
        ];
        $object->updateStats($result);
    }
}
