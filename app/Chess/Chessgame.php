<?php

namespace App\Chess;

use App\Chess\Drivers\PositionDriverInterface;
use App\Chess\Pieces\AbstractPiece;
use App\Chess\Validation\RulesValidator;
use Exception;

class Chessgame
{

    protected $move;
    protected $position;

    protected $positionDriver;

    public function __construct(PositionDriverInterface $positionDriver)
    {
        $this->positionDriver = $positionDriver;
    }

    /**
     * @param Move $move
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function run(Move $move): bool
    {
        $position = $this->positionDriver->getPosition();

        $piece = $position->extractPieceFromPosition($move->getFromCoordinate());

        if (!$piece) {
            throw new Exception('No piece found on given square.');
        }

        $piece->setMove($move);

        $isMoveLegal = $this->validateMove(new RulesValidator(), $piece, $position);

        if ($isMoveLegal) {
            $position->makeMove($move);
            $this->positionDriver->setPosition($position);
         }

        return $isMoveLegal;
    }

    /**
     * @param RulesValidator $validator
     * @param Move $move
     * @param Position $position
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function validateMove(RulesValidator $validator, AbstractPiece $piece, Position $position): bool
    {
        return $validator->validate($piece, $position);
    }

}
