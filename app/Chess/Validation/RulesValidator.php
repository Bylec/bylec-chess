<?php

namespace App\Chess\Validation;

use App\Chess\Move;
use App\Chess\Position;
use App\Chess\Validation\Rules\CanMoveToSquare;

class RulesValidator
{

    private $firstRule;

    public function __construct()
    {
        $rulesChain = new CanMoveToSquare();

        $this->firstRule = $rulesChain;
    }

    public function validate(Position $position, Move $move)
    {
        $piece = $position->extractPieceFromPosition($move);
        $piece->setPosition($position);

        return $this->firstRule->checkRule($position, $move, $piece);
    }

}