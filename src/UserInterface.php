<?php

namespace App;

class UserInterface
{
    private $heightDisplay = 10;

    public function drawHand(array $hand): void
    {
        for ($i = 0; $i < $this->heightDisplay; $i++) {
            switch ($i) {
                case 9:
                case 0:
                    foreach ($hand as $key => $card) {
                        if ($key === count($hand) - 1) {
                            echo('+---------------+');
                        } else if ($key === 0) {
                            echo('+----');
                        }
                    }
                    break;
                case 1:
                        foreach ($hand as $key => $card) {
                            if ($key === count($hand) - 1) {
                                echo('|' . json_decode('"' . $card->getColorIcon() . '"') . json_decode('"' . $card->getType() . '"') . '            |');
                            } else if ($key === 0) {
                                echo('|' . json_decode('"' . $card->getColorIcon() . '"') . json_decode('"' . $card->getType() . '"') . '  ');
                            }
                        }
                        break;
                    case 2:
                        foreach ($hand as $key => $card) {
                            if ($key === count($hand) - 1) {
                                echo("|   |" . json_decode('"\u2594\u2594\u2594\u2594\u2594\u2594\u2594"') . "|   |");
                            } else if ($key === 0) {
                                echo('|   _');
                            }
                        }
                        break;
                    case 7:
                        foreach ($hand as $key => $card) {
                            if ($key === count($hand) - 1) {
                                echo('|   |_______|   |');
                            } else if ($key === 0) {
                                echo('|   __');
                            }
                        }
                        break;
                    case 8:
                        foreach ($hand as $key => $card) {
                            if ($key === count($hand) - 1) {
                                echo('|            ' . json_decode('"' . $card->getColorIcon() . '"') . json_decode('"' . $card->getType() . '"') . '|');
                            } else if ($key === 0) {
                                echo('|   | ');
                            }
                        }
                        break;
                    default:
                        foreach ($hand as $key => $card) {
                            if ($key === count($hand) - 1) {
                                echo('|   |       |   |');
                            } else if ($key === 0) {
                                echo('|   | ');
                            }
                        }
                        break;
            }
            echo("\n");
        }
    }
}