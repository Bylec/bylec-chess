<?php

namespace App\Chess\Validation\Rules;

use App\Chess\Move;
use App\Chess\Pieces\AbstractPiece;
use App\Chess\Position;

interface RuleInterface
{

    public function setNext(AbstractRule $rule): AbstractRule;
    public function checkRule(Position $position, Move $move, AbstractPiece $piece): bool;

}