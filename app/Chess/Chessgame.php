<?php

namespace App\Chess;

use App\Chess\Drivers\PositionDriverInterface;

class Chessgame
{

    protected $move;
    protected $position;

    protected $positionDriver;

    public function __construct(PositionDriverInterface $positionDriver)
    {
        $this->positionDriver = $positionDriver;
    }

    public function run( Move $move)
    {
        $position = $this->positionDriver->getPosition();

        $this->validateMove($position, $move);

    }

    protected function validateMove(Position $position, Move $move)
    {



    }

}
