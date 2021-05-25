<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Tests\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceControllersTest extends TestCase
{
    public function testGame21StartPage()
    {
        $response = $this->get('/game');
        $response->assertStatus(200);
    }

    public function testPostGame21Start()
    {
        $response = $this->post('/game', [
            'dices' => '1',
            'action' => 'Start!']);

        $response->assertStatus(500);
        $response->assertSee('Total score:');
    }

    public function testPostGame21Roll()
    {
        $response = $this->post('/game', [
            'action' => 'Roll again']);

        $response->assertStatus(500);
        $response->assertSee('Total score:');
    }

    public function testPostGame21StopLoose()
    {
        $response = $this->post('/game', [
            'score' => '10',
            'action' => 'Stop']);

        $response->assertStatus(500);
        $response->assertSee("The Computer won!");
    }

    public function testPostGame21StopWon()
    {
        $response = $this->post('/game', [
            'score' => '21',
            'action' => 'Stop']);

        $response->assertStatus(500);
        $response->assertSee("Congratulations, you won!");
    }

    public function testPostGame21New()
    {
        $response = $this->post('/game', [
            'action' => 'New round']);
        $response->assertStatus(500);
    }

    public function testPostGame21End()
    {
        $response = $this->post('/game', [
            'action' => 'End game']);
        $response->assertStatus(302);
    }
}
