<?php

namespace App\Chess;

use App\Chess\Pieces\Bishop;
use App\Chess\Pieces\BlackPawn;
use App\Chess\Pieces\King;
use App\Chess\Pieces\Knight;
use App\Chess\Pieces\Queen;
use App\Chess\Pieces\Rook;
use App\Chess\Pieces\WhitePawn;
use App\Exceptions\ResolvePositionException;
use Exception;
use JsonSerializable;

class Position implements JsonSerializable
{

    const WHITE = 'white';
    const BLACK = 'black';

    protected $toMove = null;

    protected $board = null;

    static $pieceMap = [
        'p' => WhitePawn::class,
        'P' => BlackPawn::class,
        'r' => Rook::class,
        'R'=> Rook::class,
        'n' => Knight::class,
        'N' => Knight::class,
        'b' => Bishop::class,
        'B' => Bishop::class,
        'k' => King::class,
        'K' => King::class,
        'q' => Queen::class,
        'Q' => Queen::class,
    ];

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

    public function getBoard(): Board
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

    public function getBoardSetup()
    {
        return json_decode($this->getBoard()->getSetup(), true);
    }

    public function extractPieceFromPosition(Move $move)
    {
        $setup = $this->getBoardSetup();

        $letterPieceRepresentation = $setup[$move->getFromCoordinate()];

        if (!isset($letterPieceRepresentation)) {
            throw new Exception('No piece found on given square.');
        }

        return new static::$pieceMap[$letterPieceRepresentation]($move);
    }

}
