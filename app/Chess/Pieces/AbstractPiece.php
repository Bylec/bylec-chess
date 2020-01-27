<?php

namespace App\Chess\Pieces;

use App\Chess\Move;
use App\Chess\Position;

abstract class AbstractPiece
{

    public function getNextLetter(string $letter): string
    {
        return ++$letter;
    }

    public function getPreviousLetter(string $letter): string
    {
        return chr(ord($letter)-1);
    }

    abstract public function moveInAccordanceToRules(Move $move, Position $position): bool;
    abstract public function nothingInTheWay(): bool;

}
