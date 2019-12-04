<?php

namespace App\Chess;

use App\Exceptions\ResolvePositionException;
use JsonSerializable;

class Position implements JsonSerializable
{

    const WHITE = 'white';
    const BLACK = 'black';

    protected $toMove = null;
    protected $board = null;

    public function jsonSerialize()
    {
        return [
            'toMove' => $this->toMove,
            'board' => $this->board
        ];
    }

    public function getToMove()
    {
        return $this->toMove;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public static function resolveToPosition($json) : Position
    {
        if (!is_string($json)) {
            throw new ResolvePositionException('Argument of function has to be json string.');
        }

        $positionJson = json_decode($json);
        $positionInstance = new self();

        foreach ($positionJson as $property => $value) {
            if (!property_exists($positionInstance, $property)) continue;

            $methodName = 'set' . ucfirst($property) . 'Attribute';
            if (method_exists($positionInstance, $methodName)) {
                $positionInstance->{$methodName}($value);
            } else {
                $positionInstance->{$property} = $value;
            }
        }

        return $positionInstance;
    }

    public static function getStartingPosition() : Position
    {
        $position = new self();
        $position->toMove = self::WHITE;
        $position->board = app(Board::class)->setStartingSetup();
        return $position;
    }

    protected function setBoardAttribute($board)
    {
        $this->board = app(Board::class)->setSetup($board);
    }

}
