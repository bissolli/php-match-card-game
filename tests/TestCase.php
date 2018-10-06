<?php

use Bissolli\CardGame\Game;
use Bissolli\CardGame\Models\Player;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $game;

    public function startGame()
    {
        $playerA = new Player('Freek');
        $playerB = new Player('Bas');
        $playerC = new Player('Henk');
        $playerD = new Player('Pieter');

        $this->game = new Game();
        $this->game->addPlayers([ $playerA, $playerB, $playerC, $playerD ]);
        $this->game->serveCards();
        $this->game->start();
    }
}
