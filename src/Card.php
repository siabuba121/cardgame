<?php

declare(strict_types=1);

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

    public function getColorIcon(): ?string
    {
        switch ($this->color) {
            case 'club':
                return "\u2663";
            case 'diamond':
                return "\u2666";
            case 'spade':
                return "\u2660";
            case 'heart':
                return "\u2665";
        }

        return null;
    }

    public function getType(bool $spacer = true): string
    {
        if ('10' !== $this->type && $spacer) {
            return $this->type.' ';
        }

        return $this->type;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
