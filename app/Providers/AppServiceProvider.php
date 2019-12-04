<?php

namespace App\Providers;

use App\Chess\Drivers\CacheDriver;
use App\Chess\Drivers\PositionDriverInterface;
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
        $this->app->bind(PositionDriverInterface::class, CacheDriver::class);
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
