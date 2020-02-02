<?php

namespace App;

class UserInterface
{
    private $heightDisplay = 10;

    public function drawHand(array $hand): void
    {
        for ($i = 0; $i < $this->heightDisplay; $i++) {
            switch ($i) {
                case 0:
                    foreach ($hand as $key => $card) {
                        if ($key === array_key_last($hand)) {
                            echo '+------+';
                        } else if($key === array_key_first($hand)) {
                            echo '+---'
                        }
                    }
                    break;
                case 1:
                    break;
                case 10:
                    break;
                case 11:
                    break;
                default:
            }
        }
    }
}