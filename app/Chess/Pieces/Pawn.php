<?php

namespace App\Chess\Pieces;

abstract class Pawn extends AbstractPiece
{

    static $pawnFirstLine = null;
    static $firstMoveRange = [];

    public function moveInAccordanceToRules(): bool
    {

//        if ($this->isFirstPawnMove()) {
//            return $this->isWithinFirstMoveMovingRange();
//        } else {

            return $this->checkMoveRules();
//        }

    }

    protected function checkFirstMoveRules(): bool
    {
        return $this->isFirstPawnMove() && $this->isWithinFirstMoveMovingRange();
    }

    protected function isFirstPawnMove(): bool
    {
        return intval($this->numberFromCoordinate) === static::$pawnFirstLine;
    }

    protected function isWithinFirstMoveMovingRange(): bool
    {
        return $this->letterFromCoordinate == $this->letterToCoordinate && in_array($this->numberToCoordinate, static::$firstMoveRange);
    }

    protected function checkMoveRules()
    {
        \Log::debug($this->letterFromCoordinate == $this->letterToCoordinate && $this->numberFromCoordinate++ == $this->numberToCoordinate);
        \Log::debug(++$this->letterFromCoordinate == $this->letterToCoordinate && ++$this->numberFromCoordinate == $this->numberToCoordinate);
        \Log::debug(--$this->letterFromCoordinate == $this->letterToCoordinate && ++$this->numberFromCoordinate == $this->numberToCoordinate);
        return ($this->letterFromCoordinate == $this->letterToCoordinate && $this->numberFromCoordinate++ == $this->numberToCoordinate) ||
            (++$this->letterFromCoordinate == $this->letterToCoordinate && ++$this->numberFromCoordinate == $this->numberToCoordinate) ||
            (--$this->letterFromCoordinate == $this->letterToCoordinate && ++$this->numberFromCoordinate == $this->numberToCoordinate);
    }

}