<?php

namespace App;

class Ai
{
    private $riskStep;
    public const GETCARD = 1;
    public const PASS = 2;

    public function __construct(float $riskStep)
    {
        $this->riskStep = $riskStep;
    }

    public function decideWhatToDo(Player $player, array $deck)
    {
        $notLose = 0;
        foreach ($this->getDeckCopy($deck) as $card) {
            $hand = $this->getHandCopy($player->getHand());
            $hand[] = $card;
            $value = Deck::countHandValue($hand);
            if ($value < 21) {
                $notLose++;
            }
        }

        $probability = floor($notLose / (count($deck)) * 100);
        if($probability >= $this->riskStep) {
            return self::GETCARD;
        }
        return self::PASS;
    }

    private function getHandCopy(array $hand): array
    {
        $playerHand = [];
        foreach ($hand as $card) {
            $playerHand[] = clone $card;
        }

        return $playerHand;
    }

    private function getDeckCopy(array $deck): array
    {
        $deckCopy = [];
        foreach ($deck as $card) {
            $deckCopy[] = clone $card;
        }

        return $deckCopy;
    }
}