<?php

namespace App;

class Player
{
    private $hand = [];
    private $name;
    private $ai;

    public function __construct(string $name, bool $ai = false)
    {
        $this->ai = $ai;
        $this->name = $name;
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function addToHand(Card $card): void
    {
        $this->hand[] = $card;
    }

    /**
     * @return bool
     */
    public function isAi(): bool
    {
        return $this->ai;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}