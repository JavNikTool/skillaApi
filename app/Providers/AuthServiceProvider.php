<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Repositories\TokenRepositoryInterface;
use App\Repositories\PassportTokenRepository;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TokenRepositoryInterface::class, PassportTokenRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
