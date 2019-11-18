<?php

namespace Tests\Unit;

use App\Chess\Board;
use stdClass;
use Tests\TestCase;

class BoardTest extends TestCase
{

    /**
     * @test
     */
    public function sets_stating_setup()
    {
        $board = app(Board::class)->setStartingSetup();

        $this->assertEquals('startingSetup', $board->getSetup());
    }

    /**
     * @test
     */
    public function sets_setup()
    {
        $board = app(Board::class)->setSetup('setup');

        $this->assertEquals('setup', $board->getSetup());
    }

    /**
     * @test
     */
    public function sets_setup_when_object_given()
    {
        $stdClass = new stdClass();
        $stdClass->setup = 'setup';
        $board = app(Board::class)->setSetup($stdClass);

        $this->assertEquals('setup', $board->getSetup());
    }

}
