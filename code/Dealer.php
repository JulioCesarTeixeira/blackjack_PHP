<?php


class Dealer extends Player
{
    public const MAX_DEALER = 15;

    //parent constructor
    public function __construct(Deck $deck)
    {
        parent::__construct($deck);
    }

    public function hit(Deck $deck): void
    {
        while ($this->getScore() < self::MAX_DEALER) {
            parent::hit($deck);
        }
    }

}