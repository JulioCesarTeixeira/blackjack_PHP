<?php
declare(strict_types=1);

require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Suit.php';


class Blackjack
{
    //properties
    private Player $player;
    private Player $dealer;
    private Deck $deck;

    public function __construct()
    {
    $this->dealer = new Player($this->getDeck());
    $this->player = new Player($this->getDeck());
    $this->deck = new Deck();
    $this->deck->shuffle();
    }

    //methods
    public function getPlayer() : Player
    {
        return $this->player;
    }

    public function getDealer() : Player
    {
        return $this->dealer;
    }

    public function getDeck() : Deck
    {
        return $this->deck;
    }

}

$deck = new Deck();
$deck->shuffle();
foreach($deck->getCards() AS $card) {
    echo $card->getUnicodeCharacter(true);
    echo '<br>';
}