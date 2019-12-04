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
        if (Cache::has('position')) {
            return Position::resolveToPosition(Cache::get('position'));
        }
        return Position::getStartingPosition();
    }

    public function setPosition(Position $position)
    {
        Cache::put('position', json_encode($position), config('chessgame.cache_duration'));
    }

}
