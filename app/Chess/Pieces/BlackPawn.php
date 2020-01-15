<?php

namespace App\Chess\Pieces;

class BlackPawn extends Pawn
{

    static $pawnFirstLine = 7;
    static $firstMoveRange = [5, 6];

    protected function hasMovedOneSquareForward(): bool
    {
        return $this->getLetterFromCoordinate() == $this->getLetterToCoordinate() && $this->getNumberFromCoordinate() - 1 == $this->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheLeft()
    {
        return $this->getNextLetter($this->getLetterFromCoordinate()) == $this->getLetterToCoordinate() && $this->getNumberFromCoordinate() + -1 == $this->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheRight()
    {
        return $this->getPreviousLetter($this->getLetterFromCoordinate()) == $this->getLetterToCoordinate() && $this->getNumberFromCoordinate() + -1 == $this->getNumberToCoordinate();
    }

}
