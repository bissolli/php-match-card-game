<?php

namespace Bissolli\CardGame;

use Bissolli\CardGame\Exceptions\DeckOutOfCardsException;
use Bissolli\CardGame\Models\Card;

class DeckManager
{
    /**
     * List of available faces do build the Deck.
     *
     * @var array
     */
    protected $faces = [ "1" ,"2", "3", "4", "5", "6", "7", "8", "9", "10", "Jack", "Queen", "King" ];

    /**
     * List of available suits to build the Deck.
     *
     * @var array
     */
    protected $suits = [ "♠", "♥", "♣", "♦" ];

    /**
     * Current deck of cards.
     *
     * @var array
     */
    protected $deck = [];

    /**
     * Create a new Deck instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the deck based on the available options.
     *
     * @return $this
     */
    public function build()
    {
        foreach ($this->suits as $suit) {
            foreach ($this->faces as $face) {
                $color = in_array($suit, [ "♠", "♣" ]) ? 'Black' : 'Red';
                $this->deck[] = new Card($face, $suit, $color);
            }
        }

        return $this;
    }

    /**
     * Get deck of cards.
     *
     * @return array
     */
    public function getDeck()
    {
        return $this->deck;
    }

    /**
     * Shuffle the deck.
     *
     * @return $this
     */
    public function shuffle()
    {
        shuffle($this->deck);

        return $this;
    }

    /**
     * Get random cards from the deck.
     *
     * @param int $amount
     * @return array
     * @throws DeckOutOfCardsException
     */
    public function getRandomCards($amount = 1)
    {
        if (count($this->deck) < $amount)
            throw new DeckOutOfCardsException('There is not enough cards in the deck to do this action.');

        $cards = [];

        for ($i = 1; $i <= $amount; $i++) {
            $index = array_rand($this->deck);
            $cards[] = $this->deck[$index];
            array_splice($this->deck, $index, 1);
        }

        return $cards;
    }

    /**
     * Shift the first card from the deck.
     *
     * @return Card
     * @throws DeckOutOfCardsException
     */
    public function shiftDeck()
    {
        if (count($this->deck) == 0)
            throw new DeckOutOfCardsException('The deck is empty.');

        return array_shift($this->deck);
    }

    /**
     * Push a new card to the deck.
     *
     * @param Card $card
     * @return $this
     */
    public function addCard(Card $card)
    {
        array_push($this->deck, $card);

        return $this;
    }

    /**
     * Count amount of cards inside the deck.
     *
     * @return int
     */
    public function count()
    {
        return count($this->deck);
    }
}
