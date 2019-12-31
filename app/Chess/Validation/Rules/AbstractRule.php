<?php

namespace App\Chess\Validation\Rules;

use App\Chess\Move;
use App\Chess\Pieces\AbstractPiece;
use App\Chess\Position;

abstract class AbstractRule implements RuleInterface
{

    private $next;

    public function setNext(AbstractRule $rule): AbstractRule
    {
        $this->next = $rule;

        return $rule;
    }

    public function checkRule(Position $position, Move $move, AbstractPiece $piece): bool
    {
        if (!$this->next) {
            return true;
        }

        return $this->next->checkRule($position, $move, $piece);
    }


}