<?php

namespace App\Chess\Pieces;

use App\Chess\Move;
use App\Chess\Position;

abstract class AbstractPiece
{

    protected $move;

    public function getNextLetter(string $letter): string
    {
        return ++$letter;
    }

    public function getPreviousLetter(string $letter): string
    {
        return chr(ord($letter)-1);
    }

    public function setMove(Move $move)
    {
        $this->move = $move;
    }

    public function getMove()
    {
        return $this->move;
    }

    abstract public function nothingInTheWay(Position $position): bool;
    abstract public function moveInAccordanceToRules(): bool;

}
