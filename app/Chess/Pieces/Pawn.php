<?php

namespace App\Chess\Pieces;

use App\Chess\Position;
use Illuminate\Support\Arr;

abstract class Pawn extends AbstractPiece
{

    static $pawnFirstLine = null;
    static $firstMoveRange = [];
    static $colorThirdLine = null;
    static $enPassantLine = null;

    public function moveInAccordanceToRules(Move $move, Position $position): bool
    {
        return $this->checkMoveRules();
    }

    public function nothingInTheWay(): bool
    {
        if ($this->isFirstPawnMove() && $this->movedTwoSquaresForward()) {
            return !$this->position->isPieceOnSquare($this->move->getLetterToCoordinate() . static::$colorThirdLine);
        }

        if ($this->hasMovedOneSquareForward()) {
            return !$this->position->isPieceOnSquare($this->move->getToCoordinate());
        }

        return true;
    }

    public function canCaptureOnSquare()
    {
        return (($this->hasCapturedPieceOnTheLeft() || $this->hasCapturedPieceOnTheRight()) && ($this->position->isPieceOnSquare($this->move->getToCoordinate(), true) || $this->lastMoveAllowsEnPassant())) || $this->moveIsWithinSameLine();
    }

    protected function checkMoveRules(): bool
    {
        return $this->checkFirstMoveRules() ||
            $this->hasMovedOneSquareForward() ||
            $this->capturingPossibility();
    }

    protected function movedTwoSquaresForward(): bool
    {
        return $this->move->getNumberToCoordinate() == Arr::last(static::$firstMoveRange);
    }

    protected function checkFirstMoveRules(): bool
    {
        return $this->isFirstPawnMove() && $this->isWithinFirstMoveMovingRange();
    }

    protected function isFirstPawnMove(): bool
    {
        return $this->move->getNumberFromCoordinate() == static::$pawnFirstLine;
    }

    protected function isWithinFirstMoveMovingRange(): bool
    {
        return $this->move->getLetterFromCoordinate() == $this->move->getLetterToCoordinate() && in_array($this->move->getNumberToCoordinate(), static::$firstMoveRange);
    }

    protected function capturingPossibility(): bool
    {
        return $this->moveIsWithinLineOnTheLeft() || $this->moveIsWithinLineOnTheRight();
    }

    protected function moveIsWithinLineOnTheLeft(): bool
    {
        return $this->getPreviousLetter($this->move->getLetterFromCoordinate()) == $this->move->getLetterToCoordinate();
    }

    protected function moveIsWithinLineOnTheRight(): bool
    {
        return $this->getNextLetter($this->move->getLetterFromCoordinate()) == $this->move->getLetterToCoordinate();
    }

    protected function moveIsWithinSameLine(): bool
    {
        return $this->move->getLetterFromCoordinate() === $this->move->getLetterToCoordinate();
    }

    protected function lastMoveAllowsEnPassant()
    {
        $lastMove = $this->position->getLastMove();

        return $this->move->getFromCoordinate() === static::$enPassantLine;
    }

}
