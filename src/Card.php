<?php

namespace App;

class Card
{
    private $color;
    private $type;
    private $value;

    public function __construct(string $color, string $type)
    {
        $this->type = $type;
        $this->color = $color;
    }

    public function getColorIcon(): string
    {
        switch ($this->color) {
            case "club":
                return "\u2663";
            case "diamond":
                return "\u2666";
            case "spade":
                return "\u2660";
            case "heart":
                return "\u2665";
        }
    }

    public function getType(): string
    {
        if ($this->type !== '10') {
            return $this->type.' ';
        }
        return $this->type;
    }

//System.out.println("\u2665 This should be a Hearts suit symbol.");
//System.out.println("\u2666 This should be a Diamonds suit symbol.");
//System.out.println("\u2663 This should be a Clubs suit symbol.");
//System.out.println("\u2660 This should be a Spades suit symbol.");
}