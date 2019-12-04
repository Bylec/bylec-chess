<?php

namespace Tests\Unit;

use App\Chess\Move;
use App\Exceptions\MoveValidationFailed;
use Tests\TestCase;

class MoveTest extends TestCase
{

    /**
     * @test
     */
    public function fails_when_given_more_then_two_coordinates()
    {
        $this->expectException(MoveValidationFailed::class);

        $coordinates = ['a1', 'b2', 'c1'];

        new Move($coordinates);
    }

    /**
     * @test
     */
    public function fails_when_given_less_then_two_coordinates()
    {
        $this->expectException(MoveValidationFailed::class);

        $coordinates = ['a1'];

        new Move($coordinates);
    }

    /**
     * @test
     */
    public function fails_when_one_of_coordinates_has_more_then_two_signs()
    {
        $this->expectException(MoveValidationFailed::class);

        $coordinates = ['a1', 'b11'];

        new Move($coordinates);
    }

    /**
     * @test
     */
    public function fails_when_one_of_coordinates_has_less_then_two_signs()
    {
        $this->expectException(MoveValidationFailed::class);

        $coordinates = ['a1', 'b'];

        new Move($coordinates);
    }

    /**
     * @test
     */
    public function fails_when_one_of_coordinates_is_out_of_letter_range_then_two_signs()
    {
        $this->expectException(MoveValidationFailed::class);

        $coordinates = ['i1', 'b2'];

        new Move($coordinates);
    }

    /**
     * @test
     */
    public function fails_when_one_of_coordinates_is_out_of_number_range_then_two_signs()
    {
        $this->expectException(MoveValidationFailed::class);

        $coordinates = ['a0', 'b2'];

        new Move($coordinates);
    }

    /**
     * @test
     */
    public function returns_full_coordinates()
    {
        $coordinates = ['a1', 'b2'];

        $move = new Move($coordinates);

        $this->assertEquals('a1-b2', $move->getFullCoordinate());
    }

}
