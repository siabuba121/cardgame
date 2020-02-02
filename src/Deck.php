<?php

namespace App;

class Deck
{
    private static $colors = ['club', 'diamond', 'heart', 'spade'];
    private static $types = ['2','3','4','5','6','7','8','9','10','J','Q','K','A'];
    public const VALUES = ['2'=>2, '3'=>3, '4'=>4, '5'=>5, '6'=>6, '7'=>7, '8'=>8, '9'=>9, '10'=>10, 'J'=>2, 'Q'=>3, 'K'=>4, 'A'=>11];

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

    public static function countHandValue(array $hand): int
    {
        $value = 0;
        foreach ($hand as $card) {
            $value += Deck::VALUES[$card->getType(false)];
        }

        return $value;
    }
}