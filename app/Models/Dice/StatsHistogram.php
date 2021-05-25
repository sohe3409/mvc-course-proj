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
        } elseif ($score != 21) {
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

    public function getStats(): array
    {
        $object = new Stats();
        $user = $object->getUserData();
        $all = $object->getAllStats();
        $allW = 0;
        $allP = 0;
        $allT = 0;


        foreach ($all as $one) {
            $allW += (int)$one['won'];
            $allP += (int)$one['played'];
            $allT += (int)$one['tweone'];
        }

        $stats = [
            'user21' => $this->percentage($user['tweone'], $user['played']),
            "userWins" => $this->percentage($user['won'], $user['played']),
            "all21" => $this->percentage($allT, $allP),
            "allWins" => $this->percentage($allW, $allP)
        ];

        return $stats;
    }

    public function percentage($won, $played): string
    {
        if ($won == 0 || $played == 0) {
            return "0%";
        }
        $percent = ($won / $played) * 100;
        return strval(round($percent)) . "%";
    }
}
