<?php

namespace LMeuwly\Sendinblue;

use Illuminate\Support\ServiceProvider;

class SendinblueServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(Sendinblue::class, function () {
            return new Sendinblue(config('sendinblue.apikey'));
        });

        $this->publishes([
            __DIR__.'/../config/sendinblue.php' => config_path('sendinblue.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->bind('sendinblue', function () {
            return $this->app->make(Sendinblue::class);
        });

        $this->mergeConfigFrom(__DIR__.'/../config/sendinblue.php', 'sendinblue');
    }
}