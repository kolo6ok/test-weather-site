<?php

namespace App\Providers;

use App\Services\Rpc\JsonRpcClient;
use App\Services\Weather\WeatherService;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WeatherService::class, function () {
            $url = env('URL_WEATHER', 'http://host.docker.internal:8080/api/rpc');
            return new WeatherService(
                new JsonRpcClient($url)
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
