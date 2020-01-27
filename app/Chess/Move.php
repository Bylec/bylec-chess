<?php

namespace App\Chess;

use App\Chess\Pieces\AbstractPiece;
use App\Exceptions\MoveValidationFailed;

class Move
{

    protected $fromCoordinate;
    protected $toCoordinate;

    protected $letterFromCoordinate;
    protected $numberFromCoordinate;
    protected $letterToCoordinate;
    protected $numberToCoordinate;

    protected $piece;

    /**
     * Move constructor.
     * @param array $coordinatePairs
     * @throws MoveValidationFailed
     */
    public function __construct(array $coordinatePairs)
    {
        $this->validateCoordinatePairs($coordinatePairs);

        $this->fromCoordinate = $coordinatePairs[0];
        $this->toCoordinate = $coordinatePairs[1];

        $this->letterFromCoordinate = $this->fromCoordinate[0];
        $this->numberFromCoordinate = $this->fromCoordinate[1];
        $this->letterToCoordinate = $this->toCoordinate[0];
        $this->numberToCoordinate = $this->toCoordinate[1];
    }

    protected function validateCoordinatePairs($coordinatePairs)
    {
        if (count($coordinatePairs) !== 2) {
            throw new MoveValidationFailed('Only two coordinates can describe move.');
        }

        collect($coordinatePairs)->each(function($coordinate) {
            $this->validateCoordinate($coordinate);
        });
    }

    protected function validateCoordinate($coordinate)
    {
        if (strlen($coordinate) !== 2) {
            throw new MoveValidationFailed('Coordinate must contain only one letter and one number.');
        }

        if (!is_string($coordinate[0]) || !ctype_alpha($coordinate[0]) || $coordinate[0] < 'a' || $coordinate[0] > 'h' ||
            !is_numeric($coordinate[1]) || !ctype_digit($coordinate[1]) || $coordinate[1] < 1 || $coordinate[1] > 8) {
            throw new MoveValidationFailed('Coordinate range must be between a1 and h8.');
        }
    }

    public function setPiece(AbstractPiece $piece)
    {
        $this->piece = $piece;
    }

    public function getPiece(): AbstractPiece
    {
        return $this->piece;
    }

    public function getFromCoordinate(): string
    {
        return $this->fromCoordinate;
    }

    public function getToCoordinate(): string
    {
        return $this->toCoordinate;
    }

    public function getFullCoordinate(): string
    {
        return $this->fromCoordinate . '-' . $this->toCoordinate;
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

}
