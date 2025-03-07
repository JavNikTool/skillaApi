<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class PassportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addDay());
    }
}
