<?php

use Bissolli\CardGame\DeckManager;
use Bissolli\CardGame\Game;
use Bissolli\CardGame\Models\Card;
use Bissolli\CardGame\Models\Player;

class GameTest extends TestCase
{
    /** @test */
    public function assertDeckBuilder()
    {
        $deck = new DeckManager();
        $deck->build();

        $this->assertEquals(52, $deck->count());
    }

    /** @test */
    public function assertDeckShuffle()
    {
        $deck = new DeckManager();
        $deck->build();

        $this->assertNotEquals($deck->getDeck(), $deck->shuffle()->getDeck());
    }

    /** @test */
    public function assertPushNewCard()
    {
        $this->startGame();

        $cardA = new Card('1', '♥', 'Red');
        $cardB = new Card('2', '♥', 'Red');
        $cardC = new Card('1', '♣', 'Black');
        $cardD = new Card('2', '♣', 'Black');

        $this->game->setCurrentCard($cardA);
        $this->assertTrue($this->game->playCard($cardB));

        $this->game->setCurrentCard($cardA);
        $this->assertTrue($this->game->playCard($cardC));

        $this->game->setCurrentCard($cardA);
        $this->assertFalse($this->game->playCard($cardD));
    }

    /** @test */
    public function assertAddPlayer()
    {
        $playerA = new Player('Freek');
        $playerB = new Player('Bas');
        $playerC = new Player('Henk');

        $game = new Game();
        $game->addPlayers([ $playerA, $playerB ]);

        $this->assertEquals(2, count($game->getPlayers()));

        $game->addPlayers($playerC);
        $this->assertEquals(3, count($game->getPlayers()));
    }

    /** @test */
    public function assertShiftDeck()
    {
        $this->startGame();
        $deckCount = $this->game->getDeck()->count();

        $this->assertEquals(23, $deckCount);

        $this->game->getDeck()->shiftDeck();
        $deckCount = $this->game->getDeck()->count();

        $this->assertEquals(22, $deckCount);
    }

    /** @test */
    public function assertHandCount()
    {
        $this->startGame();
        $playerA = $this->game->getPlayers()[0];

        $this->assertEquals(get_class($playerA), Player::class);

        $this->assertEquals(7, $playerA->countHand());
    }
}
