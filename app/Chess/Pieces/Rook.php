<?php

namespace App\Chess\Pieces;

use App\Chess\Position;

class Rook extends AbstractPiece
{
    public function nothingInTheWay(Position $position): bool
    {
        $coordinatesToCheck = $this->getCoordinatesToCheck();

        if (empty($coordinatesToCheck)) {
            return false;
        }

        return !($position->isPieceOnSquares($coordinatesToCheck) || $position->isSameColorPieceOnSquare($this->move->getToCoordinate()));
    }

    public function moveInAccordanceToRules(): bool
    {
        return $this->move->letterCoordinatesAreEqual() || $this->move->numberCoordinatesAreEqual();
    }

    public function canCaptureOnSquare(Position $position): bool
    {
        return true;
    }

    protected function getCoordinatesToCheck(): array
    {
        if ($this->move->letterCoordinatesAreEqual()) {
            return $this->getVerticalCoordinates();
        }

        if ($this->move->numberCoordinatesAreEqual()) {
            return $this->getHorizontalCoordinates();
        }

        return [];
    }

    protected function getHorizontalCoordinates()
    {
        return collect(range($this->move->getLetterFromCoordinate(), $this->getPreviousLetter($this->move->getLetterToCoordinate())))->map(function($letter) {
            return $letter . $this->move->getNumberFromCoordinate();
        })->toArray();
    }

    protected function getVerticalCoordinates()
    {
        return collect(range($this->move->getNumberFromCoordinate(), $this->move->getNumberToCoordinate() - 1))->map(function ($number) {
            return $this->move->getLetterFromCoordinate() . $number;
        })->toArray();
    }
}