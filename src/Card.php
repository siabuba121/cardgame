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
}