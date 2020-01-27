<?php

namespace App\Chess;

use App\Chess\Drivers\PositionDriverInterface;
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
        $piece = $position->extractPieceFromPosition($move);
        $move->setPiece($piece);

        $isMoveLegal = $this->validateMove(new RulesValidator(), $move, $position);

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
    protected function validateMove(RulesValidator $validator, Move $move, Position $position): bool
    {
        if (!$move->getPiece()) {
            throw new Exception('Move has to have piece set before validating rules');
        }

        return $validator->validate($move, $position);
    }

}
