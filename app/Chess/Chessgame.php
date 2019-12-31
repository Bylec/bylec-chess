<?php

namespace App\Chess;

use App\Chess\Drivers\PositionDriverInterface;
use App\Chess\Validation\RulesValidator;

class Chessgame
{

    protected $move;
    protected $position;

    protected $positionDriver;

    public function __construct(PositionDriverInterface $positionDriver)
    {
        $this->positionDriver = $positionDriver;
    }

    public function run(Move $move): bool
    {
        $position = $this->positionDriver->getPosition();

        return $this->validateMove(new RulesValidator(), $position, $move);
    }

    protected function validateMove(RulesValidator $validator, Position $position, Move $move): bool
    {
        return $validator->validate($position, $move);
    }

}
