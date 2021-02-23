<?php
declare(strict_types=1);

require_once 'Deck.php';
require_once 'Card.php';
class Player
{
    //properties
    private bool $lost = false;
    private array $cards = [];

    public const MAX_NUMBER = 21;

    //constructor
    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        if (count($this->cards) === 1) {
            $this->cards[] = $deck->drawCard();
        }
    }

    //methods
    public function hit(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        if(count($this->cards) > self::MAX_NUMBER) {
            $this->cards = $this->cards->hasLost(); //From here
        }
    }

    public function surrender()
    {


    }

    public function getScore(Deck $deck) : int//
    {
        $totalScore = 0;
    foreach ($this->cards AS $card){
        $totalScore += $card->value;
    }
    return $totalScore;
    }

    public function hasLost() : bool
    {
        return $this->lost = true;
    }
}
