<?php

namespace App\Chess\Pieces;

class BlackPawn extends Pawn
{

    static $pawnFirstLine = 7;
    static $firstMoveRange = [5, 6];
    static $colorThirdLine = 6;
    static $enPassantLine = 4;

    protected function hasMovedOneSquareForward(): bool
    {
        return $this->move->getLetterFromCoordinate() == $this->move->getLetterToCoordinate() && $this->move->getNumberFromCoordinate() - 1 == $this->move->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheRight(): bool
    {
        return $this->getNextLetter($this->move->getLetterFromCoordinate()) == $this->move->getLetterToCoordinate() && $this->move->getNumberFromCoordinate() + -1 == $this->move->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheLeft(): bool
    {
        return $this->getPreviousLetter($this->move->getLetterFromCoordinate()) == $this->move->getLetterToCoordinate() && $this->move->getNumberFromCoordinate() + -1 == $this->move->getNumberToCoordinate();
    }

}
