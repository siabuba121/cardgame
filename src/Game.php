<?php

declare(strict_types=1);

namespace App;

class Game
{
    private $gameGoing = true;
    private $players = [];
    private $userInterface;
    private $deck;

    public function __construct()
    {
        $this->userInterface = new UserInterface();
    }

    public function start(): void
    {
        $this->deck = Deck::getDeck();
        $this->preparePlayers(1, 1);
        foreach ($this->players as $player) {
            if ($player->isAi()) {
                $this->userInterface->drawHandHeader('Computer', $player->getHand());
            } else {
                $this->userInterface->drawHandHeader('Player', $player->getHand());
            }
            $this->userInterface->drawHand($player->getHand());
        }

        while ($this->gameGoing) {
            foreach ($this->players as $player) {
                $this->userInterface->clearConsole();
                if ($player->isAi()) {
                    $this->moveAi($player);
                } else {
                    $this->movePlayer($player);
                }
                $this->checkIfGameEnds();
            }
        }
        $this->userInterface->requireAcceptForNextStep('Game ended press enter to continue');
        $this->askToPlayAgain();
    }

    private function preparePlayers(int $normal, int $ai): void
    {
        for ($i = 0; $i < $normal; $i++) {
            $player = new Player('Marek');
            $player->addToHand($this->getCardFromDeck());
            $this->players[] = $player;
        }

        for ($i = 0; $i < $ai; $i++) {
            $player = new Player('computer', true);
            $player->addToHand($this->getCardFromDeck());
            $this->players[] = $player;
        }
    }

    private function getCardFromDeck(): Card
    {
        return array_pop($this->deck);
    }

    private function moveAi(Player $player): void
    {
        $player->addToHand($this->getCardFromDeck());
        echo"Computer draws card\n";
        $this->userInterface->drawHandHeader($player->getName(), $player->getHand());
        $this->userInterface->drawHand($player->getHand());
        $this->userInterface->requireAcceptForNextStep('Next player turn.. press enter');
    }

    private function movePlayer(Player $player): void
    {
        $correctAction = false;
        $this->userInterface->drawHandHeader($player->getName(), $player->getHand());
        $this->userInterface->drawHand($player->getHand());

        echo"\nWhat you want to do next:\n1: draw card\n2: pass\n";
        while (! $correctAction) {
            $handle = fopen('php://stdin', 'r');
            $line = fgets($handle);
            if ('1' === trim($line)) {
                $player->addToHand($this->getCardFromDeck());
                $correctAction = true;
            }
            if ('2' === trim($line)) {
                $correctAction = true;
            }
            if ('2' !== trim($line) && '1' !== trim($line)) {
                echo"Not allowed option selected please select valid one\n";
            }
        }
    }

    private function checkIfGameEnds(): void
    {
        foreach ($this->players as $player) {
            if (21 === Deck::countHandValue($player->getHand())) {
                $this->userInterface->clearConsole();
                echo 'Player '.$player->getName()." won game\n";
                $this->userInterface->drawHand($player->getHand());
                $this->gameGoing = false;
                break;
            }
            if (Deck::countHandValue($player->getHand()) > 21) {
                $this->userInterface->clearConsole();
                echo 'Player '.$player->getName()." lost game\n";
                $this->userInterface->drawHand($player->getHand());
                $this->gameGoing = false;
                break;
            }
        }
    }

    private function askToPlayAgain(): void
    {
        $this->userInterface->clearConsole();
        echo"if you want to play again click type 'restart' and click enter\n";
        $handle = fopen('php://stdin', 'r');
        $line = fgets($handle);
        if ('restart' === trim($line)) {
            $this->restartGame();
        }
    }

    private function restartGame(): void
    {
        $this->gameGoing = true;
        $this->players = [];
        $this->start();
    }
}
