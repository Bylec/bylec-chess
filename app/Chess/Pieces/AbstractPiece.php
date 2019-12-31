<?php

namespace App\Chess\Pieces;

use App\Chess\Move;

abstract class AbstractPiece
{

    abstract public function isInAccordanceToMovingRules(Move $move): bool;

}