<?php

namespace App\Chess\Pieces;

class WhitePawn extends Pawn
{

    static $pawnFirstLine = 2;
    static $firstMoveRange = [3, 4];

    protected function hasMovedOneSquareForward(): bool
    {
        return $this->getLetterFromCoordinate() == $this->getLetterToCoordinate() && $this->getNumberFromCoordinate() + 1 == $this->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheLeft()
    {
        return $this->getNextLetter($this->getLetterFromCoordinate()) == $this->getLetterToCoordinate() && $this->getNumberFromCoordinate() + 1 == $this->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheRight()
    {
        return $this->getPreviousLetter($this->getLetterFromCoordinate()) == $this->getLetterToCoordinate() && $this->getNumberFromCoordinate() + 1 == $this->getNumberToCoordinate();
    }

}
