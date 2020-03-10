<?php

namespace App\Chess\Pieces;

use App\Chess\Position;

class Knight extends AbstractPiece
{
    public function moveInAccordanceToRules(): bool
    {
        $squares = $this->generateSquaresKnightCanMoveTo();

        return false;
        return in_array($this->move->getToCoordinate(), $squares);
    }

    public function nothingInTheWay(Position $position): bool
    {
        // TODO: Implement nothingInTheWay() method.
    }

    public function canCaptureOnSquare(Position $position): bool
    {
        // TODO: Implement canCaptureOnSquare() method.
    }

    protected function generateSquaresKnightCanMoveTo()
    {
        $letterFrom = $this->move->getLetterFromCoordinate();

        $squares = collect(range(chr(ord($letterFrom)-2), chr(ord($letterFrom)+2)));
    }
}