<?php

declare(strict_types=1);

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
        $this->sortHand();
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

    private function sortHand()
    {
        $this->sortHandByColor();
        $this->sortHandByValue();
    }

    private function sortHandByColor()
    {
        $sorted = false;
        while(!$sorted) {
            $moveAction = false;
            foreach ($this->hand as $index => $card) {
                if ($index <= count($this->hand) - 2) {
                    if (array_search($card->getColor(), Deck::$colors) > array_search($this->hand[$index + 1]->getColor(), Deck::$colors)) {
                        $moveAction = true;
                        $cardDown = $card;
                        $cardUp = $this->hand[$index + 1];
                        $this->hand[$index] = $cardUp;
                        $this->hand[$index + 1] = $cardDown;
                    }
                }
            }
            if ($moveAction === false) {
                $sorted = true;
            }
        }
    }

    private function sortHandByValue()
    {
        $sorted = false;
        while(!$sorted) {
            $moveAction = false;
            foreach ($this->hand as $index => $card) {
                if ($index <= count($this->hand) - 2) {
                    if ($card->getColor() === $this->hand[$index+1]->getColor()){
                        if (array_search($card->getType(false), Deck::VALUES) > array_search($this->hand[$index+1]->getType(false), Deck::VALUES)){
                            $moveAction = true;
                            $cardDown = $card;
                            $cardUp = $this->hand[$index + 1];
                            $this->hand[$index] = $cardUp;
                            $this->hand[$index + 1] = $cardDown;
                        }
                    }
                }
            }
            if ($moveAction === false) {
                $sorted = true;
            }
        }
    }
}
