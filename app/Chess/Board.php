<?php

namespace App\Chess;

use JsonSerializable;

class Board implements JsonSerializable
{

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
        $this->setup = 'startingSetup';
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
