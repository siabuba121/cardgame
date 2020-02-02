<?php

namespace App;

class Card
{
    private $color;
    private $type;

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

    public function getType(bool $spacer = true): string
    {
        if ($this->type !== '10' && $spacer) {
            return $this->type.' ';
        }
        return $this->type;
    }
}