<?php


namespace App\Chess\Drivers;


use App\Chess\Position;

interface PositionDriverInterface
{

    public function getPosition() : Position;
    public function setPosition(Position $position);

}
