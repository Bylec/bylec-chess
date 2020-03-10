<?php

namespace App\Chess\Pieces;

use App\Chess\Position;

class Bishop extends AbstractPiece
{
    public function moveInAccordanceToRules(): bool
    {
        $squares = $this->generateSquaresBishopCanMoveTo();

        return in_array($this->move->getToCoordinate(), $squares);
    }

    public function nothingInTheWay(Position $position): bool
    {
        return true;
    }

    public function canCaptureOnSquare(Position $position): bool
    {
        return true;
    }

    protected function generateSquaresBishopCanMoveTo(): array
    {
        $letterFrom = $this->move->getLetterFromCoordinate();
        return array_merge($this->getSquaresByRange($letterFrom, 'a')['squares'], $this->getSquaresByRange($letterFrom, 'h')['squares']);
    }

    protected function getSquaresByRange($starLetter, $endLetter): array
    {
        return collect(range($starLetter, $endLetter))
            ->reduce(function($carry, $letter) use ($starLetter) {
                if ($letter == $starLetter) {
                    $carry['squares'][] = $this->move->getFromCoordinate();
                    $carry['current_number_positive'] = $this->move->getNumberFromCoordinate();
                    $carry['current_number_negative'] = $this->move->getNumberFromCoordinate();
                } else {
                    $carry = $this->getNegativeYAxis($carry, $letter);
                    $carry = $this->getPositiveYAxis($carry, $letter);
                }

                return $carry;
            });
    }

    protected function getPositiveYAxis(array $carry, string $letter)
    {
        $carry['current_number_positive']++;
        if ($carry['current_number_positive'] <= 8) {
            $carry['squares'][] = $letter . $carry['current_number_positive'];
        }

        return $carry;
    }

    protected function getNegativeYAxis(array $carry, string $letter)
    {
        $carry['current_number_negative']--;
        if ($carry['current_number_negative'] >= 1) {
            $carry['squares'][] = $letter . $carry['current_number_negative'];
        }

        return $carry;
    }
}