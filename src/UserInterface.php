<?php

namespace App;

class UserInterface
{
    private $heightDisplay = 10;

    public function drawHandHeader(string $playerId, array $hand): void
    {
        echo("Player: ".$playerId." points:".Deck::countHandValue($hand)." cards:\n");
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
            echo("\n");
        }
    }

    private function printNormalLine(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                echo('|   |       |   |');
            } else {
                echo('|   ');
            }
        }
    }

    private function printTopColorLine(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                echo('|' . json_decode('"' . $card->getColorIcon() . '"') . json_decode('"' . $card->getType() . '"') . '            |');
            } else {
                echo('|' . json_decode('"' . $card->getColorIcon() . '"') . json_decode('"' . $card->getType() . '"'));
            }
        }
    }

    private function printTopBottomline(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                echo('+---------------+');
            } else {
                echo('+---');
            }
        }
    }

    private function printUnderColorLine(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                echo("|   |" . json_decode('"\u2594\u2594\u2594\u2594\u2594\u2594\u2594"') . "|   |");
            } else {
                echo('|   ');
            }
        }
    }

    private function printBottomColorLine(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                echo('|            ' . json_decode('"' . $card->getColorIcon() . '"') . $card->getType() . '|');
            } else {
                echo('|   ');
            }
        }
    }

    private function printOverColorBottomLine(array $hand): void
    {
        foreach ($hand as $key => $card) {
            if ($key === count($hand) - 1) {
                echo('|   |_______|   |');
            } else {
                echo('|   ');
            }
        }
    }

    public function clearConsole(){
        for ($i=0; $i<50; $i++) {
            echo("\n");
        }
    }

    public function requireAcceptForNextStep(string $message)
    {
        echo($message."\n");
        $handle = fopen ("php://stdin","r");
        fgets($handle);
    }
}