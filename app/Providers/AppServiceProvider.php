<?php

namespace App\Providers;

use App\Chess\Chessgame;
use Facade\App\Chess\Chessgame as ChessgameFacade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ChessgameFacade::class, Chessgame::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
