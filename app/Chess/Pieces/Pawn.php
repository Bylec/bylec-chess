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

    public function nothingInTheWay($position): bool
    {
        if ($this->isFirstPawnMove() && $this->movedTwoSquaresForward()) {
            return !$position->isPieceOnSquare($this->move->getLetterToCoordinate() . static::$colorThirdLine);
        }

        if (!$this->capturingPossibility()) {
            return !$position->isPieceOnSquare($this->move->getToCoordinate());
        }

       return true;
    }

    public function moveInAccordanceToRules(): bool
    {
        return $this->checkMoveRules();
    }

    public function canCaptureOnSquare(Position $position): bool
    {
        return (($this->hasCapturedPieceOnTheLeft() || $this->hasCapturedPieceOnTheRight())
                && ($position->isOppositeColorPieceOnSquare($this->move->getToCoordinate()) || $this->lastMoveAllowsEnPassant($position)))
                || $this->moveIsWithinSameLine();
    }

    public function checkMoveRules(): bool
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
        return $this->move->letterCoordinatesAreEqual() && in_array($this->move->getNumberToCoordinate(), static::$firstMoveRange);
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
        return $this->move->letterCoordinatesAreEqual();
    }

    protected function lastMoveAllowsEnPassant(Position $position)
    {
        $lastMove = $position->getLastMove();

        /** @var Pawn $lastMovePiece */
        $lastMovePiece = $position->extractPieceFromPosition($lastMove->getToCoordinate());
        $lastMovePiece->setMove($lastMove);

        return $this->move->getNumberFromCoordinate() == static::$enPassantLine
            && $this->move->getLetterToCoordinate() === $lastMove->getLetterToCoordinate()
            && $lastMovePiece->isFirstPawnMove()
            && $lastMovePiece->movedTwoSquaresForward();
    }

}
