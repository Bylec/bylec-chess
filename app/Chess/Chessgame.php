<?php

namespace App\Chess;

use App\Chess\Drivers\PositionDriverInterface;

class Chessgame
{

    protected $move;
    protected $position;

    public function run(PositionDriverInterface $positionDriver, Move $move)
    {
        $position = $positionDriver->getPosition();

        $this->validateMove($position, $move);

    }

    protected function validateMove(Position $position, Move $move)
    {



    }

}
