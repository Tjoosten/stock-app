<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['events']->listen(Authenticated::class, function ($event): void {
            view()->share('currentUser', $event->user);
        });
    }
}
