<?php

namespace NotificationChannels\Lob;

use Lob\Lob;
use Illuminate\Support\ServiceProvider;

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
