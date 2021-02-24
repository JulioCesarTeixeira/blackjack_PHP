<?php
declare(strict_types=1);


class Player
{
    //properties
    private bool $lost = false;
    private array $cards = [];
    public const MAX_NUMBER = 21; //blackjack max number to avoid magic numbers

    //constructor - adds a card to play, if the number of cards = 1, give a second card to player.
    public function __construct(Deck $deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();

    }

    //methods
    public function hit(Deck $deck) //draw a card. If to getScore returns bigger than 21, change $lost property to true.
    : void
    {
        $this->cards[] = $deck->drawCard();
        if ($this->getScore() > self::MAX_NUMBER) {
            $this->lost = true;
        }
        if ($this->getScore() === self::MAX_NUMBER) {
            $this->lost = false;
        }
    }

    //adjust this
    public function surrender(): void
    {
        $this->lost = true;
    }

    public function getScore(): int
    {
        $totalScore = 0;
        foreach ($this->cards as $card) {
            $totalScore += $card->getValue();
        }
        return $totalScore;

    }

    public function hasLost(): bool
    {
        return $this->lost;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function stand()
    {
    }

    public function isLost(): bool
    {
        return $this->lost;
    }


    public function setLost(bool $lost): void
    {
        $this->lost = $lost;
    }


    //check winner
    public function isWinner(Dealer $dealer): bool
    {
        if ($dealer->getScore() === self::MAX_NUMBER){
            $this->lost = true;
            $dealer->setLost(false);
        }
        else if ($this->getScore() === self::MAX_NUMBER){
            $this->lost = false;
            $dealer->setLost(true);
        }
        else if(!$dealer->hasLost() && $this->getScore() > $dealer->getScore()){
            $this->lost = false;
            $dealer->setLost(true);
        } else if($dealer->hasLost()){
            $this->lost = false;
            $dealer->setLost(true);
        } else {
            $this->lost = true;
            $dealer->setLost(false);
        }
        return !$this->lost;
    }
}