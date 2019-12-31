<?php

namespace App\Chess\Pieces;

use App\Chess\Move;

class Pawn extends AbstractPiece
{

    public function isInAccordanceToMovingRules(Move $move): bool
    {
        if (!$this->isInSameOrNextColumn()) {
            return false;
        }

        return true;
    }

    public function isInSameOrNextColumn()
    {

    }

}