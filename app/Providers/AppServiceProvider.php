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
                    'base_uri' => getenv('TELEGRAM_BOT_URL') . '/' . getenv('TELEGRAM_BOT_TOKEN') . '/api/'
                ])
            );
        });
    }
}
