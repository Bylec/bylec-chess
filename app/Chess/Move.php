<?php

namespace App\Chess;

use App\Exceptions\MoveValidationFailed;

class Move
{

    protected $fromCoordinate;
    protected $toCoordinate;

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

}
