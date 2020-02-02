<?php

namespace App;

class Deck
{
    private static $colors = ['club', 'diamond', 'heart', 'spade'];
    private static $types = ['2','3','4','5','6','7','8','9','10','J','Q','K','A'];

    public static function getDeck(): array
    {
        $deck = [];
        foreach (self::$colors as $color) {
            foreach (self::$types as $type) {
                $deck[] = new Card($color, $type);
            }
        }

        shuffle($deck);
        return $deck;
    }
}