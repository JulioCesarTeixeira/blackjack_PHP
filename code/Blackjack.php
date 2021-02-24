<?php
declare(strict_types=1);


class Blackjack
{
    //properties
    private Player $player;
    private Dealer $dealer;
    private Deck $deck;

    public function __construct()
    {
        $this->deck = new Deck();
        $this->deck->shuffle();
        $this->dealer = new Dealer($this->getDeck());
        $this->player = new Player($this->getDeck());
    }

    //methods
    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getDealer(): Dealer
    {
        return $this->dealer;
    }

    public function getDeck(): Deck
    {
        return $this->deck;
    }

//    public function checkWinner()
//    {
//        if ($_SESSION['blackjack']->getPlayer()->showScores() > $_SESSION['blackjack']->getDealer()->showScores()) {
//            if ($_SESSION['blackjack']->getPlayer()->hasLost(true)) {
//                return true;
//            }
//        } else if ($_SESSION['blackjack']->getPlayer()->showScores() === 21) {
//            return $_SESSION['blackjack']->getDealer()->hasLost(true);
//        }
//    }
}
