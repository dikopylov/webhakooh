<?php

namespace App\Providers;

use App\Connectors\TelegramBotConnector;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TelegramBotConnector::class, function ($app) {
            return new TelegramBotConnector(
                 new Client([
                    // Base URI is used with relative requests
                    'base_uri' => env('TELEGRAM_BOT_URL') . '/' . env('TELEGRAM_BOT_TOKEN'),
                    // You can set any number of default request options.
                    'timeout'  => 2.0,
                ])
            );
        });
    }
}
