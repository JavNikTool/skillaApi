<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Order\OrderController;
use App\Http\Controllers\V1\User\AuthController;
use App\Http\Controllers\V1\Worker\FilterController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'throttle:60'])->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    /*Route::get('test', function (){
        return \App\Models\Worker::with('excludedOrderTypes')->get();
    });*/
});

Route::middleware(['auth:api', 'throttle:60'])->group(function () {
   Route::post('logout', [AuthController::class, 'logout'])->name('logout');

   Route::prefix('orders')->group(function () {
       Route::post('/', [OrderController::class, 'store']);
       Route::post('/{order}/assign-worker', [OrderController::class, 'assignWorker']);
   });

    Route::prefix('workers')->group(function () {
        Route::post('/filter', [FilterController::class, 'filterByOrderTypes']);
    });
});

Route::prefix('passport')->group(base_path('routes/api/v1/passport.php'));
