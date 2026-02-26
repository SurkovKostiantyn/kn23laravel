<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Примусовий HTTPS для Vercel або Production
        if (config('app.env') === 'production' || isset($_SERVER['HTTPS'])) {
            URL::forceScheme('https');
        }
    }
}
