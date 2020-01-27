<?php

namespace App\Chess\Pieces;

class WhitePawn extends Pawn
{

    static $pawnFirstLine = 2;
    static $firstMoveRange = [3, 4];
    static $colorThirdLine = 3;
    static $enPassantLine = 5;

    protected function hasMovedOneSquareForward(): bool
    {
        return $this->move->getLetterFromCoordinate() == $this->move->getLetterToCoordinate() && $this->move->getNumberFromCoordinate() + 1 == $this->move->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheRight(): bool
    {
        return $this->getNextLetter($this->move->getLetterFromCoordinate()) == $this->move->getLetterToCoordinate() && $this->move->getNumberFromCoordinate() + 1 == $this->move->getNumberToCoordinate();
    }

    protected function hasCapturedPieceOnTheLeft(): bool
    {
        return $this->getPreviousLetter($this->move->getLetterFromCoordinate()) == $this->move->getLetterToCoordinate() && $this->move->getNumberFromCoordinate() + 1 == $this->move->getNumberToCoordinate();
    }

}
