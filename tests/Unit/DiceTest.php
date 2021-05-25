<?php

declare(strict_types=1);

namespace App\Models\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the controller Form.
 */
class ClassDiceTest extends TestCase
{
    public function testDiceRoll()
    {
        $dice = new Dice();
        $res = $dice->roll();
        $this->assertTrue($res > 0 && $res < 7);
    }

    public function testDiceGetLastRoll()
    {
        $dice = new Dice();
        $res1 = $dice->roll();
        $res2 = $dice->getLastRoll();
        $this->assertTrue($res1 === $res2);
    }

    public function testHandRoll()
    {
        $hand = new DiceHand();
        $hand->roll();

        for ($i = 0; $i <= 4; $i++) {
            $this->assertTrue($hand->dices[$i]->getLastRoll() > 0
            && $hand->dices[$i]->getLastRoll() < 7);
        }
    }
}
