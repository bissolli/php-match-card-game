<?php

namespace Bissolli\CardGame\Models;

class Player
{
    /**
     * The player's name.
     *
     * @var string|null
     */
    protected $name;

    /**
     * The player's hand.
     *
     * @var array
     */
    protected $hand = [];

    /**
     * Create a new Player instance.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get player's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get player's hand.
     *
     * @return array
     */
    public function getHand()
    {
        return $this->hand;
    }

    /**
     * Set player's hand.
     *
     * @param array $hand
     */
    public function setHand($hand)
    {
        $this->hand = $hand;
    }

    /**
     * Push the given Card to the player's hand.
     *
     * @param Card $card
     */
    public function addCardToHand(Card $card)
    {
        array_push($this->hand, $card);
    }

    /**
     * Get player's hand in a readable string.
     *
     * @return string
     */
    public function stringfyHand()
    {
        $hand = '';

        foreach ($this->hand as $card) {
            $hand .= "{$card->toString()} ";
        }

        return $hand;
    }

    /**
     * Count number of card in the hand.
     *
     * @return int
     */
    public function countHand()
    {
        return count($this->hand);
    }

    /**
     * Fetch similar card from the player's hand based on the given card
     * considering only face and color attributes.
     *
     * @param Card $card
     * @return bool|Card
     */
    public function fetchSimilarCard(Card $card)
    {
        $filter = array_filter($this->hand, function ($obj) use ($card) {
            return $obj->getColor() == $card->getColor() || $obj->getFace() == $card->getFace();
        });

        if (count($filter) == 0) {
            return false;
        }

        $filterKeys = array_keys($filter);
        $keyRand = array_rand($filterKeys);
        $similarCard = $filter[$filterKeys[$keyRand]];

        array_splice($this->hand, $filterKeys[$keyRand], 1);

        return $similarCard;
    }
}
