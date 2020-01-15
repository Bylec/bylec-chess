<?php

namespace App\Chess\Pieces;

use App\Chess\Move;
use App\Chess\Position;

abstract class AbstractPiece
{

    protected $letterFromCoordinate;
    protected $numberFromCoordinate;
    protected $letterToCoordinate;
    protected $numberToCoordinate;

    protected $position;

    public function __construct(Move $move)
    {
        $fromCoordinate = $move->getFromCoordinate();
        $toCoordinate = $move->getToCoordinate();

        $this->letterFromCoordinate = $fromCoordinate[0];
        $this->numberFromCoordinate = $fromCoordinate[1];
        $this->letterToCoordinate = $toCoordinate[0];
        $this->numberToCoordinate = $toCoordinate[1];
    }

    public function setPosition(Position $position)
    {
        $this->position = $position;
    }

    public function getNextLetter(string $letter): string
    {
        return ++$letter;
    }

    public function getPreviousLetter(string $letter): string
    {
        return chr(ord($letter)-1);
    }

    public function getLetterFromCoordinate()
    {
        return $this->letterFromCoordinate;
    }

    public function getNumberFromCoordinate()
    {
        return $this->numberFromCoordinate;
    }

    public function getLetterToCoordinate()
    {
        return $this->letterToCoordinate;
    }

    public function getNumberToCoordinate()
    {
        return $this->numberToCoordinate;
    }

    abstract public function moveInAccordanceToRules(): bool;

}
