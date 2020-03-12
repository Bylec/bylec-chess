<?php

namespace App\Chess\Pieces;

use App\Chess\Position;

class Rook extends AbstractPiece
{
    public function nothingInTheWay(Position $position): bool
    {
        $coordinatesToCheck = $this->getCoordinatesToCheck();

        if (is_null($coordinatesToCheck)) {
            return false;
        }

        return $position->noPiecesOnSquares($coordinatesToCheck) && !$position->isSameColorPieceOnSquare($this->move->getToCoordinate());
    }

    public function moveInAccordanceToRules(): bool
    {
        return $this->move->letterCoordinatesAreEqual() || $this->move->numberCoordinatesAreEqual();
    }

    public function canCaptureOnSquare(Position $position): bool
    {
        return $position->isOppositeColorPieceOnSquare($this->move->getToCoordinate()) || $this->moveInAccordanceToRules();
    }

    protected function getCoordinatesToCheck(): array
    {
        if ($this->move->letterCoordinatesAreEqual()) {
            return $this->getVerticalCoordinates();
        }

        if ($this->move->numberCoordinatesAreEqual()) {
            return $this->getHorizontalCoordinates();
        }

        return null;
    }

    protected function getHorizontalCoordinates()
    {
        $sortedCoordinates = collect([$this->move->getLetterFromCoordinate(), $this->move->getLetterToCoordinate()])
            ->sort();
        $range = range($sortedCoordinates->first(), $sortedCoordinates->last());
        return collect($range)
            ->reject(function($value, $key) use ($range) {
                return $key == 0 || $key == count($range) - 1;
            })
            ->map(function ($letter) {
                return $letter . $this->move->getNumberFromCoordinate();
            })->toArray();
    }

    protected function getVerticalCoordinates()
    {
        $sortedCoordinates = collect([$this->move->getNumberFromCoordinate(), $this->move->getNumberToCoordinate()])
            ->sort();
        $range = range($sortedCoordinates->first(), $sortedCoordinates->last());
        return collect($range)
            ->reject(function($value, $key) use ($range) {
                return $key == 0 || $key == count($range) - 1;
            })
            ->map(function ($number) {
                return $this->move->getLetterFromCoordinate() . $number;
            })->toArray();
    }
}
