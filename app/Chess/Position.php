<?php

namespace App\Chess;

use App\Chess\Pieces\AbstractPiece;
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

    const WHITE = 0;
    const BLACK = 1;

    protected $toMove = null;
    protected $board = null;

    /** @var Move */
    protected $lastMove = null;

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
            'board' => $this->board,
            'lastMove' => $this->lastMove
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

    public function setBoard(Board $board)
    {
        $this->board = $board;
    }

    public function getLastMove(): ?Move
    {
        return $this->lastMove;
    }

    public function setLastMove(Move $move): void
    {
        $this->lastMove = $move;
    }

//    public static function resolveToPosition($position) : Position
//    {
//        $positionInstance = new self();
//
//        foreach ($position as $property => $value) {
//            if (!property_exists($positionInstance, $property)) continue;
//
//            $methodName = 'set' . ucfirst($property) . 'Attribute';
//            if (method_exists($positionInstance, $methodName)) {
//                $positionInstance->{$methodName}($value);
//            } else {
//                $positionInstance->{$property} = $value;
//            }
//        }
//
//        return $positionInstance;
//    }

    public static function getStartingPosition() : Position
    {
        $position = new self();
        $position->toMove = self::WHITE;
        $position->board = app(Board::class)->setStartingSetup();
        return $position;
    }

//    protected function setBoardAttribute($board)
//    {
//        $this->board = app(Board::class)->setSetup($board->getSetup());
//    }

    public function getBoardSetup()
    {
        return $this->getBoard()->getSetup();
    }

    public function extractPieceFromPosition(string $square): AbstractPiece
    {
        $letterPieceRepresentation = $this->getLetterPieceRepresentation($square);

        if (!isset($letterPieceRepresentation)) {
            return null;
        }

        return new static::$pieceMap[$letterPieceRepresentation];
    }

    public function isPieceOnSquare(string $coordinate): bool
    {
        $letterPieceRepresentation = $this->getLetterPieceRepresentation($coordinate);

        if (!$letterPieceRepresentation) {
            return false;
        }

        return true;
    }

    public function isPieceOnSquares(array $squares): bool
    {
        $squaresCollection = collect($squares);

        $boardSetup = $this->getBoardSetup();

        return $squaresCollection->count() != $squaresCollection->intersect($boardSetup)->count();
    }

    public function isSameColorPieceOnSquare(string $coordinate)
    {
        $letterPieceRepresentation = $this->getLetterPieceRepresentation($coordinate);

        if (!$letterPieceRepresentation) {
            return false;
        }

        return $this->toMove == self::WHITE ? $this->isPieceWhite($letterPieceRepresentation) : $this->isPieceBlack($letterPieceRepresentation);
    }

    public function isOppositeColorPieceOnSquare(string $coordinate)
    {
        $letterPieceRepresentation = $this->getLetterPieceRepresentation($coordinate);

        if (!$letterPieceRepresentation) {
            return false;
        }

        return $this->toMove == self::BLACK ? $this->isPieceWhite($letterPieceRepresentation) : $this->isPieceBlack($letterPieceRepresentation);
    }

    public function checkColorOfPiece($letterPieceRepresentation): int
    {
        return ctype_upper($letterPieceRepresentation) ? self::BLACK : self::WHITE;
    }

    protected function isPieceBlack($letterPieceRepresentation): bool
    {
        return $this->checkColorOfPiece($letterPieceRepresentation) === self::BLACK;
    }

    protected function isPieceWhite($letterPieceRepresentation): bool
    {
        return $this->checkColorOfPiece($letterPieceRepresentation) === self::WHITE;
    }

    protected function getLetterPieceRepresentation(string $fromSquare): ?string
    {
        $setup = $this->getBoardSetup();
        return @$setup[$fromSquare];
    }

    public function makeMove(Move $move): void
    {
        $boardSetup = $this->getBoardSetup();

        $letterPieceRepresentation = $boardSetup[$move->getFromCoordinate()];
        unset($boardSetup[$move->getFromCoordinate()]);
        $boardSetup[$move->getToCoordinate()] = $letterPieceRepresentation;

        $board = $this->getBoard();
        $board->setSetup($boardSetup);
        $this->setBoard($board);
        $this->changeToMove();
        $this->setLastMove($move);
    }

    public function changeToMove(): void
    {
        $this->toMove = $this->toMove == self::WHITE ? self::BLACK : self::WHITE;
    }

}
