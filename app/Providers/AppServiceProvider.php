<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\Event;
use App\Classes\Calendar\Events\WeeklyEvent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Event::class, WeeklyEvent::class);
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
