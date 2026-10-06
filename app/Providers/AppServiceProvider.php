<?php

namespace App\Providers;

use App\Calendar\CalendarService;
use App\Calendar\Sources\ConventusRssSource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CalendarService::class, fn () => new CalendarService([
            new ConventusRssSource(config('calendar.conventus.rss_url')),
        ]));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
