<?php

namespace App\Chess\Validation\Rules;

use App\Chess\Pieces\AbstractPiece;
use App\Chess\Position;

interface RuleInterface
{

    public function setNext(AbstractRule $rule): AbstractRule;
    public function checkRule(AbstractPiece $piece, Position $position): bool;

}
