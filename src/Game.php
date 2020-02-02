<?php

namespace App;

//EXAMPLE BLACKJACK
class Game
{
    private $gameGoing = true;
    private $players = [];
    private $userInterface;
    private $deck;

    public function start(): void
    {
        $this->userInterface = new UserInterface();
        $this->deck = Deck::getDeck();
        $this->preparePlayers(1,1);
        var_dump($this->players);
    }

    private function preparePlayers(int $normal, int $ai)
    {
        for ($i=0; $i<$normal; $i++) {
            $player = new Player();
            $player->addToHand($this->getCardFromDeck());
            $this->players[] = $player;
        }

        for ($i=0; $i<$ai; $i++) {
            $player = new Player();
            $player->addToHand($this->getCardFromDeck());
            $this->players[] = $player;
        }
    }

    private function getCardFromDeck(): Card
    {
        return array_pop($this->deck);
    }
}