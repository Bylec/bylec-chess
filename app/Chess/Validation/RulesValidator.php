<?php

namespace App\Chess\Validation;

use App\Chess\Move;
use App\Chess\Position;
use App\Chess\Validation\Rules\CanCaptureOnSquare;
use App\Chess\Validation\Rules\CanMoveToSquare;
use App\Chess\Validation\Rules\NothingInTheWay;

class RulesValidator
{

    private $firstRule;

    /**
     * RulesValidator constructor.
     */
    public function __construct()
    {
        $canMoveToSquareRule = new CanMoveToSquare();
        $nothingInTheWayRule = new NothingInTheWay();
        $canCaptureOnSquareRule = new CanCaptureOnSquare();

        $canMoveToSquareRule->setNext($nothingInTheWayRule)->setNext($canCaptureOnSquareRule);

        $this->firstRule = $canMoveToSquareRule;
    }

    /**
     * @param Move $move
     * @param Position $position
     * @return bool
     */
    public function validate(Move $move, Position $position)
    {
        return $this->firstRule->checkRule($move, $position);
    }

}
