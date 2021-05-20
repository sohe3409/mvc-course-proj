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

    public function testDiceGraphical()
    {
        $dice = new GraphicalDice();
        $res1 = $dice->roll();
        $res2 = $dice->getLastRoll();
        $res3 = $dice->graphical();
        $res4 = "dice-" . (string)$dice->getLastRoll();
        $this->assertTrue($res1 === $res2);
        $this->assertTrue($res3 === $res4);
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

    public function testHandGetLastRoll()
    {
        $hand = new DiceHand(2);
        $hand->roll();
        $res1 = $hand->getLastRoll();
        $res2 = (string)$hand->dices[0]->getLastRoll() . ", " .
        (string)$hand->dices[1]->getLastRoll() . ", " . " = " . (string)$hand->sum;

        $this->assertEquals($res1, $res2);
    }

    public function testHistogram()
    {
        $arr = [1,2,2];
        $dice = new DiceHistogram();
        $dice->setHistogramSerie($arr);
        $res2 = $dice->getHistogramSerie();
        $res = $dice->printHistogram();
        $res1 = "1: *<br>2: **<br>";

        $this->assertEquals($res2, $arr);
        $this->assertEquals($res1, $res);
    }
}
