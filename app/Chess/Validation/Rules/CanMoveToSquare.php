<?php

namespace App\Chess\Validation\Rules;

use App\Chess\Move;
use App\Chess\Pieces\AbstractPiece;
use App\Chess\Position;

class CanMoveToSquare extends AbstractRule
{

    public function checkRule(Position $position, Move $move, AbstractPiece $piece): bool
    {
        if (!$piece->moveInAccordanceToRules()) {
            return false;
        }

        return parent::checkRule($position, $move, $piece);
    }

}