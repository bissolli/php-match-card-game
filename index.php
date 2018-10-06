<?php

require_once('vendor/autoload.php');

use Bissolli\CardGame\Game;
use Bissolli\CardGame\Models\Card;
use Bissolli\CardGame\Models\Player;

/**
 * Instantiate all the players
 */
$playerA = new Player('Freek');
$playerB = new Player('Bas');
$playerC = new Player('Henk');
$playerD = new Player('Pieter');

/**
 * Instantiate all the game
 */
$game = new Game();

try {

    // Enroll all the players into the game
    $game->addPlayers([ $playerA, $playerB, $playerC, $playerD ]);

    // Serve 7 cards for each player
    $game->serveCards();

    // Show players name
    echo "Starting game with {$game->stringfyPlayers()}<br>";

    // Show hand of each player
    foreach ($game->getPlayers() as $player) {
        echo "{$player->getName()} has been dealt: {$player->stringfyHand()} <br>";
    }

    // Start the game with the top card of the deck
    $game->start();
    echo "Top card is: {$game->getCurrentCard()->toString()}<br>";

    // While game is on, we loop the users until find the winner
    $gameOn = true;
    while($gameOn) {

        foreach ($game->getPlayers() as $player) {

            // Get a similar card on the user's hand, if exists
            $match = $player->fetchSimilarCard($game->getCurrentCard());

            // If there is a similar card
            if ($match instanceof Card) {

                // Play the given card and print it
                $game->playCard($match);
                echo "{$player->getName()} plays {$match->toString()}<br>";

                // If player has no card left he wins the game
                if ($player->countHand() === 0) {
                    echo "{$player->getName()} has won";
                    $gameOn = false;
                    break;
                }

            // In case no similar card is found, user gets on from the deck
            } else {
                $card = $game->getDeck()->shiftDeck();
                $player->addCardToHand($card);
                echo "{$player->getName()} does not have a suitable card, taking from deck {$card->toString()}<br>";
            }

        }

    }

} catch (\Bissolli\CardGame\Exceptions\DeckOutOfCardsException $e) {
    echo "Ooops... We are out of card in the deck. Game over =)";
} catch (\Bissolli\CardGame\Exceptions\NotEnoughPlayersException $e) {
    echo $e->getMessage();
} catch (\Exception $e) {
    echo $e->getMessage();
}
