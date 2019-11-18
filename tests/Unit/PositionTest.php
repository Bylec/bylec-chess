<?php

namespace Tests\Unit;

use App\Chess\Board;
use App\Chess\Position;
use App\Exceptions\ResolvePositionException;
use Tests\TestCase;

class PositionTest extends TestCase
{

    /**
     * @test
     */
    public function position_cannot_be_resolved_when_json_is_not_passed()
    {
        $this->expectException(ResolvePositionException::class);
        Position::resolveToPosition(null);
    }

    /**
     * @test
     */
    public function position_resolves_to_properties_when_resolved_from_json()
    {
        $json = '{"toMove":"white","board":{"setup":"setup"}}';

        $position = Position::resolveToPosition($json);

        $this->assertEquals('white', $position->getToMove());
        $this->assertInstanceOf(Board::class, $position->getBoard());
        $this->assertEquals('setup', $position->getBoard()->getSetup());
    }

    /**
     * @test
     */
    public function position_resolves_to_properties_when_starting_position_initialized()
    {
        $position = Position::getStartingPosition();

        $this->assertEquals('white', $position->getToMove());
        $this->assertInstanceOf(Board::class, $position->getBoard());
        $this->assertEquals('startingSetup', $position->getBoard()->getSetup());
    }

}
