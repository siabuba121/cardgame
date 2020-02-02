<?php

namespace App;

class Player
{
    private $hand = [];
    private $ai;

    public function __construct(bool $ai = false)
    {
        $this->ai = $ai;
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function addToHand(Card $card): void
    {
        $this->hand[] = $card;
    }
}