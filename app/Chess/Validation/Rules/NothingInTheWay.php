<?php


namespace App\Chess\Validation\Rules;


use App\Chess\Move;
use App\Chess\Pieces\AbstractPiece;
use App\Chess\Position;

class NothingInTheWay extends AbstractRule
{

    public function checkRule(Move $move, Position $position): bool
    {
        if (!$move->getPiece()->nothingInTheWay()) {
            return false;
        }

        return parent::checkRule($move, $position);
    }

}
