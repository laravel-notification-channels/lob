<?php

namespace NotificationChannels\Lob;

use Illuminate\Support\ServiceProvider;
use Lob\Lob;

class LobServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(LobChannel::class)
            ->needs(Lob::class)
            ->give(function () {
                $config = config('services.lob');

                return new Lob(
                    $config['api_key']
                );
            });
    }
}
