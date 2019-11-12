<?php

namespace App\Chess;

class Move
{

    /**
     * Move constructor.
     * @param array $coordinatePairs
     * @throws \Exception
     */
    public function __construct(array $coordinatePairs)
    {
        $this->validateCoordinatePairs($coordinatePairs);
    }

    protected function validateCoordinatePairs($coordinatePairs)
    {
        if (count($coordinatePairs) !== 2) {
            throw new \Exception('Only two coordinates can describe move.');
        }

        collect($coordinatePairs)->each(function($coordinate) {

        });
    }

    protected function validateMove($coordinate)
    {
        if (count($coordinate) !== 2) {
            throw new \Exception('Coordinate must contain only one letter and one number.');
        }

        if ($coordinate[0] < 'a' || $coordinate[0] > 'h' || $coordinate[1] < 1 || $coordinate[1] > 8) {
            throw new \Exception('');
        }
    }

}
