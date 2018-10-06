<?php

namespace Bissolli\CardGame;

use Bissolli\CardGame\Exceptions\NotEnoughPlayersException;
use Bissolli\CardGame\Models\Card;
use Bissolli\CardGame\Models\Player;

class Game
{
    const INIT_CARDS_AMOUNT = 7;

    /**
     * List of players.
     *
     * @var array Player
     */
    protected $players = [];

    /**
     * Deck of cards.
     *
     * @var array|DeckManager
     */
    protected $deck = [];

    /**
     * Leftover deck.
     *
     * @var array|DeckManager
     */
    protected $leftOverDeck = [];

    /**
     * Last card revealed.
     *
     * @var Card
     */
    protected $currentCard;

    /**
     * Create a new Game instance.
     * Build and shuffle the deck.
     *
     * @return void
     */
    public function __construct()
    {
        $this->deck = new DeckManager();
        $this->leftOverDeck = new DeckManager();

        $this->deck->build()->shuffle();
    }

    /**
     * Get the deck.
     *
     * @return array
     */
    public function getDeck()
    {
        return $this->deck;
    }

    /**
     * Get the leftover deck.
     *
     * @return array
     */
    public function getLeftOverDeck()
    {
        return $this->leftOverDeck;
    }

    /**
     * Get the list of players.
     *
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Get the current card.
     *
     * @return Card
     */
    public function getCurrentCard()
    {
        return $this->currentCard;
    }

    /**
     * Set the current card.
     *
     * @param Card $card
     */
    public function setCurrentCard(Card $card)
    {
        $this->currentCard = $card;
    }

    /**
     * Enroll players to da game.
     *
     * @param array|Player $players
     */
    public function addPlayers($players)
    {
        if (is_array($players)) {
            $this->players = array_merge($this->players, $players);
        } else {
            array_push($this->players, $players);
        }
    }

    /**
     * Serve the initial cards to the enrolled players.
     * Minimum of 2 players to play the game.
     *
     * @throws NotEnoughPlayersException
     * @throws DeckOutOfCardsException
     * @throws Exceptions\DeckOutOfCardsException
     */
    public function serveCards()
    {
        if (count($this->players) < 2)
            throw new NotEnoughPlayersException('You need at least 2 players to start the game.');

        foreach ($this->players as $player) {
            $cards = $this->deck->getRandomCards(self::INIT_CARDS_AMOUNT);
            $player->setHand($cards);
        }
    }

    /**
     * Start the game revealing the first card of the deck.
     *
     * @throws Exceptions\DeckOutOfCardsException
     */
    public function start()
    {
        $this->currentCard = $this->deck->shiftDeck();
        $this->leftOverDeck->addCard($this->currentCard);
    }

    /**
     * Get the players names.
     *
     * @return string
     */
    public function stringfyPlayers()
    {
        $players = '';

        foreach ($this->players as $i => $player) {
            if ($i > 0) $players .= ', ';
            $players .= $player->getName();
        }

        return $players;
    }

    /**
     * Play the given card
     *
     * @param Card $card
     * @return bool
     */
    public function playCard(Card $card)
    {
        if (
            $card->getFace() !== $this->currentCard->getFace()
            && $card->getColor() !== $this->currentCard->getColor()
        ) {
            return false;
        }

        $this->leftOverDeck->addCard($card);
        $this->setCurrentCard($card);

        return true;
    }
}
