<?php

namespace App\Chess\Validation\Rules;

use App\Chess\Pieces\AbstractPiece;
use App\Chess\Position;

class NothingInTheWay extends AbstractRule
{

    public function checkRule(AbstractPiece $piece, Position $position): bool
    {
        if (!$piece->nothingInTheWay($position)) {
            return false;
        }

        return parent::checkRule($piece, $position);
    }

}
