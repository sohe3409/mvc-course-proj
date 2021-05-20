<?php

declare(strict_types=1);

namespace App\Models\Dice;

/**
 * Class Dice.
 */
class Dice
{
    public $faces;
    private $roll;

    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);

        return $this->roll;
    }

    public function getLastRoll(): int
    {
        return $this->roll;
    }
}
