<?php

namespace App\Chess;

use JsonSerializable;

class Board implements JsonSerializable
{

    const STARTING_SETUP = '{"a1":"r","b1":"n","c1":"b","d1":"q","e1":"k","f1":"b","g1":"n","h1":"r"}';

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