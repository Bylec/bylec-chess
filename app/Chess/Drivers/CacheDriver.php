<?php

namespace App\Chess\Drivers;

use App\Chess\Position;
use Illuminate\Support\Facades\Cache;

class CacheDriver implements PositionDriverInterface
{

    /**
     * @return Position
     * @throws \Exception
     */
    public function getPosition() : Position
    {
        return Cache::has('position') ? Cache::get('position') : Position::getStartingPosition();
    }

    public function setPosition(Position $position)
    {
        Cache::put('position', $position, config('chessgame.cache_duration'));
    }

}
