<?php

declare(strict_types=1);

namespace App\Models\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    public $dices;
    private $amount;
    public $sum = 0;
    public $result = [];

    public function __construct(int $amount = 5)
    {
        $this->amount = $amount - 1;
        for ($i = 0; $i <= $this->amount; $i++) {
            $this->dices[$i] = new DiceHistogram();
        }
    }

    public function roll(): void
    {
        $num = ["one", "two", "three", "four", "five", "six"];
        $count = 0;
        $this->sum = 0;
        for ($i = 0; $i <= $this->amount; $i++) {
            $this->sum += $this->dices[$i]->roll();
            $count = $this->dices[$i]->getLastRoll();
            $this->result[$i] = $num[($count - 1)];
        }
    }
}
