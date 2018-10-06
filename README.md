# PHP Card Game
Simple card game built in PHP that let players have fun playing against each other. Wins who gets its own hand empty first!

> BADGES

## Installation
To get started, require this composer package:

```bash
composer require bissolli/php-match-card-game
```

Or simply clone the project, run `composer install` and check the `index.php` file

## Game rules
- The deck consists out of 52 cards.
- Every player starts with same amount of cards (`default: 7`).
- Game starts with the top card of the deck which is gonna create the leftover deck.
- Each turn another player places a card on the top of the leftover deck.
- This card must be of the same value or from the same color.
- If player cannot place a card, he should get a new card on the deck and skip his turn.
- The first player that doesn’t have any cards left, wins the game.

## Usage
The first step to start the game is instantiating the Game class which is going to be our "Game Manager" and get the deck ready and shuffled.
```php
$game = new \Bissolli\CardGame\Game();
```

Once we have the game ready, we need to add the players - you can add as much players as you wish as long as the deck supports it.
Remember, each player starts with 7 cards and the deck has a total of 52 cards.
```php
$playerA = new \Bissolli\CardGame\Models\Player('Freek');
$playerB = new \Bissolli\CardGame\Models\Player('Bas');
$playerC = new \Bissolli\CardGame\Models\Player('Henk');
$playerD = new \Bissolli\CardGame\Models\Player('Pieter');

$game->addPlayers([ $playerA, $playerB, $playerC, $playerD ]);

// Adding one by one also works
// $game->addPlayers($playerA);
// $game->addPlayers($playerB);
// ...
```

As long as we have the deck ready and the players enrolled, let's server 7 cards for each player.
```php
$game->serveCards();
```

To start the game and shift the top card from the deck to the leftover deck:
```php
$game->start();
```

From now on we all all the following methods available
````php
// To get the current card
// @return \Bissolli\CardGame\Models\Card
$game->getCurrentCard();

// To get all the players
// @return array of \Bissolli\CardGame\Models\Player
$game->getPlayers();

// To play a card - add the the leftover deck and set as current
$game->playCard(Card $card);

// Get deck
// @returns DeckManager
$game->getDeck();

// Get leftover deck
// @returns DeckManager
$game->getLeftOverDeck();

// Get players name - comma separated
$game->stringfyPlayers();
````

See below methods available for the Card model
```php
// Get card's face
$card->getFace();

// Get card's color
$card->getColor();

// Get card's suit
$card->getSuit();

// Get card's full name (face + suit)
$card->toString();
```

See below methods available for the Player model
```php
// Get player's name
$player->getName();

// Get player's hand
// @return array of Card
$player->getHand();

// Add card to player's hand
$player->addCardToHand(Card $card);

// Get player's hand as string
$player->stringfyHand();

// See if there is a similar card in the player's hand
$player->fetchSimilarCard(Card $cardToBeCompared);

// Count how many card there is left with the player
$player->countHand();
```

See below methods available for the DeckManager
```php
// Get the list of the cards in the deck 
$deck->getDeck();

// Shuffle the deck
$deck->shuffle();

// Get X random cards from the deck
$deck->getRandomCards(int $amount);

// Shift the top card from the deck
$deck->shiftDeck();

// Add a card to the deck
$deck->addCard(Card $card);

// Count how many card there is in the deck
$deck->count();
```

## Output
You can see a code example in the `./index.php` which should output something like this:
```html
Starting game with Freek, Bas, Henk, Pieter
Freek has been dealt: 1♠ King♠ 6♦ Jack♠ 9♣ Jack♥ 3♦ 
Bas has been dealt: 10♠ Queen♦ 10♦ 3♣ Jack♦ 9♠ Jack♣ 
Henk has been dealt: 6♥ 1♣ 9♦ 1♥ 1♦ 8♦ 6♠ 
Pieter has been dealt: 7♣ Queen♥ 4♠ 9♥ 2♦ 2♠ 8♣ 
Top card is: 6♣
Freek plays King♠
Bas plays 3♣
Henk plays 6♠
Pieter plays 2♠
Freek plays Jack♠
Bas plays Jack♦
Henk plays 8♦
Pieter plays 2♦
Freek plays 3♦
Bas plays Queen♦
Henk plays 6♥
Pieter plays Queen♥
Freek plays 6♦
Bas plays 10♦
Henk plays 1♥
Pieter plays 9♥
Freek plays 9♣
Bas plays Jack♣
Henk plays 1♣
Pieter plays 8♣
Freek plays 1♠
Bas plays 9♠
Henk plays 9♦
Pieter does not have a suitable card, taking from deck 4♦
Freek plays Jack♥
Freek has won
```

## Author
- [Gustavo Bissolli](mailto:gustavo.bissolli@gmail.com)

## License

Laravel Cashier is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
