<?php

declare(strict_types=1);

namespace App;

use _HumbugBox3ab8cff0fda0\PhpParser\Node\Stmt\Label;

class UserInterface
{
    private $heightDisplay = 10;

    public function drawHandHeader(string $playerId, array $hand): void
    {
        printf(
            "Player: %s points %d cards:\n",
            $playerId,
            Deck::countHandValue($hand)
        );
    }

    public function drawHand(array $hand): void
    {
        for ($i = 0; $i < $this->heightDisplay; $i++) {
            switch ($i) {
                case 9:
                case 0:
                    $this->printTopBottomline($hand);
                    break;
                case 1:
                    $this->printTopColorLine($hand);
                    break;
                case 2:
                    $this->printUnderColorLine($hand);
                    break;
                case 7:
                    $this->printOverColorBottomLine($hand);
                    break;
                case 8:
                    $this->printBottomColorLine($hand);
                    break;
                default:
                    $this->printNormalLine($hand);
                    break;
            }
            echo"\n";
        }
    }

    private function printNormalLine(array $hand): void
    {
        foreach (array_keys($hand) as $key) {
            if ($key === count($hand) - 1) {
                echo'|   |       |   |';
            } else {
                echo'|   ';
            }
        }
    }

    private function printTopColorLine(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                printf(
                    '%s%s%s%s',
                    '|',
                    json_decode('"' . $card->getColorIcon() . '"'),
                    $card->getType(),
                    '            |'
                );
            } else {
                printf(
                    '%s%s%s',
                    '|',
                    json_decode('"' . $card->getColorIcon() . '"'),
                    $card->getType()
                );
            }
        }
    }

    private function printTopBottomline(array $hand): void
    {
        foreach (array_keys($hand) as $key) {
            if ($key === count($hand) - 1) {
                echo'+---------------+';
            } else {
                echo'+---';
            }
        }
    }

    private function printUnderColorLine(array $hand): void
    {
        foreach (array_keys($hand) as $key) {
            if ($key === count($hand) - 1) {
                printf(
                    '%s%s%s',
                    '|   |',
                    json_decode('"\u2594\u2594\u2594\u2594\u2594\u2594\u2594"'),
                    '|   |'
                );
            } else {
                echo'|   ';
            }
        }
    }

    private function printBottomColorLine(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                printf(
                    '%s%s%s%s',
                    '|            ',
                    json_decode('"' . $card->getColorIcon() . '"'),
                    $card->getType(),
                    '|'
                );
            } else {
                echo'|   ';
            }
        }
    }

    private function printOverColorBottomLine(array $hand): void
    {
        foreach (array_keys($hand) as $key) {
            if ($key === count($hand) - 1) {
                echo'|   |_______|   |';
            } else {
                echo'|   ';
            }
        }
    }

    public function clearConsole(): void
    {
        for ($i = 0; $i < 50; $i++) {
            echo"\n";
        }
    }

    public function requireAcceptForNextStep(string $message): void
    {
        echo$message."\n";
        $handle = fopen('php://stdin', 'r');
        fgets($handle);
    }

    public function showHand(Player $player)
    {
        $this->drawHandHeader($player->getName(), $player->getHand());
        $this->drawHand($player->getHand());
        $this->requireAcceptForNextStep('Next player turn.. press enter');
    }

    public function anounceResult(
        string $result,
        Game $game,
        Player $player = null
    ): void{
        $this->clearConsole();
        $game->setGameGoing(false);


        switch ($result) {
            case "win":
                echo 'Player '.$player->getName()." won game\n";
                break;
            case "lose":
                echo 'Player '.$player->getName()." lost game\n";
                break;
            case "tie":
                echo "Game ended with tie!";
                return;
        }

        $this->drawHand($player->getHand());
    }
}
