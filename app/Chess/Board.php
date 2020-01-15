<?php

namespace App\Chess;

use JsonSerializable;

class Board implements JsonSerializable
{

    const STARTING_SETUP =
        '{
          "a1": "r",
          "b1": "n",
          "c1": "b",
          "d1": "q",
          "e1": "k",
          "f1": "b",
          "g1": "n",
          "h1": "r",
          "a2": "p",
          "b2": "p",
          "c2": "p",
          "d2": "p",
          "e2": "p",
          "f2": "p",
          "g2": "p",
          "h2": "p",
          "a8": "R",
          "b8": "N",
          "c8": "B",
          "d8": "Q",
          "e8": "K",
          "f8": "B",
          "g8": "N",
          "h8": "R",
          "a7": "P",
          "b7": "P",
          "c7": "P",
          "d7": "P",
          "e7": "P",
          "f7": "P",
          "g7": "P",
          "h7": "P"
        }';

    protected $setup;

    public function jsonSerialize()
    {
        return [
            'setup' => $this->setup,
        ];
    }

    public function getSetup()
    {
        return $this->setup;
    }

    public function setStartingSetup()
    {
        $this->setup = self::STARTING_SETUP;
        return $this;
    }

    public function setSetup($setup)
    {
        if (is_object($setup) && property_exists($setup, 'setup')) {
            $this->setup = $setup->setup;
        } else {
            $this->setup = $setup;
        }
        return $this;
    }

}
