<?php

namespace App\Providers;

use App\Contracts\Services\ResourceServiceInterface;
use App\Http\Controllers\V1\Base\CrudController;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
