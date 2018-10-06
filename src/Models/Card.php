<?php

namespace Bissolli\CardGame\Models;

class Card
{
    /**
     * The card's face.
     *
     * @var string
     */
    protected $face;

    /**
     * The card's suit.
     *
     * @var string
     */
    protected $suit;

    /**
     * The card's color.
     *
     * @var string
     */
    protected $color;

    /**
     * Create a new Card instance.
     *
     * @param string $face
     * @param string $suit
     * @param string $color
     */
    public function __construct($face, $suit, $color)
    {
        $this->face = $face;
        $this->suit = $suit;
        $this->color = $color;
    }

    /**
     * Get card's color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Get card's suit.
     *
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Get card's face.
     *
     * @return string
     */
    public function getFace()
    {
        return $this->face;
    }

    /**
     * Get card's name (face + suit).
     *
     * @return string
     */
    public function toString()
    {
        return $this->face . $this->suit;
    }
}
