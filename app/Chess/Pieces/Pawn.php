<?php

namespace App\Chess\Pieces;

abstract class Pawn extends AbstractPiece
{

    static $pawnFirstLine = null;
    static $firstMoveRange = [];

    public function moveInAccordanceToRules(): bool
    {
        return $this->checkMoveRules();
    }

    protected function checkFirstMoveRules(): bool
    {
        return $this->isFirstPawnMove() && $this->isWithinFirstMoveMovingRange();
    }

    protected function isFirstPawnMove(): bool
    {
        return $this->getNumberFromCoordinate() == static::$pawnFirstLine;
    }

    protected function isWithinFirstMoveMovingRange(): bool
    {
        return $this->getLetterFromCoordinate() == $this->getLetterToCoordinate() && in_array($this->getNumberToCoordinate(), static::$firstMoveRange);
    }

    protected function checkMoveRules(): bool
    {
        return $this->checkFirstMoveRules() ||
            $this->hasMovedOneSquareForward() ||
            $this->hasCapturedPieceOnTheRight() ||
            $this->hasCapturedPieceOnTheLeft();
    }

}
