<?php

namespace App\Http\Controllers;

use App\Chess\Move;
use Exception;
use Facades\App\Chess\Chessgame;
use App\Events\MoveMade;
use Illuminate\Http\Request;

class MoveController extends Controller
{

    public function index(Request $request)
    {
        try {
            Chessgame::run(new Move($request->all()));
        } catch (Exception $exception) {

        }

//        event(new MoveMade($request->all()));
    }

}
