<?php

namespace App\Http\Controllers;

use App\Chess\Drivers\CacheDriver;
use App\Chess\Drivers\PositionDriverInterface;
use App\Chess\Move;
use App\Events\MoveMade;
use App\Exceptions\MoveValidationFailed;
use Exception;
use Facades\App\Chess\Chessgame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MoveController extends Controller
{

    public function index(PositionDriverInterface $positionDriver)
    {
        $position = $positionDriver->getPosition();

        $positionDriver->setPosition($position);

        return response()->json($position);
    }

    public function move(Request $request)
    {
        try {
            $result = Chessgame::run(new Move($request->all()), new CacheDriver());
        } catch (MoveValidationFailed $exception) {
            return response('Wrong move coordinates passed.', 400);
        } catch (Exception $exception) {
            \Log::debug($exception);
            return response($exception->getMessage(), 400);
        }

        if ($result) {
            broadcast(new MoveMade($request->all()))->toOthers();
        }

        return response()->json($result);
    }

    public function restart()
    {
        Cache::forget('position');
    }

}
