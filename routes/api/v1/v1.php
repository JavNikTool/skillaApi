<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Order\OrderController;
use App\Http\Controllers\V1\User\AuthController;
use App\Http\Controllers\V1\Worker\AuthController as WorkerAuthController;
use App\Http\Controllers\V1\Worker\WorkerController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'throttle:60'])->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('/worker/login', [WorkerAuthController::class, 'login']);
});

Route::middleware(['auth:api', 'throttle:60'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'store']);
        Route::put('/{order}/status', [OrderController::class, 'updateStatus']);
        Route::post('/{order}/assign-worker', [OrderController::class, 'assignWorker']);
    });

    Route::prefix('workers')->group(function () {
        Route::get('/', [WorkerController::class, 'index']);
    });
});

Route::middleware(['auth:worker', 'throttle:60'])->group(function () {
    Route::post('logout', [WorkerAuthController::class, 'logout']);
});

Route::prefix('passport')->group(base_path('routes/api/v1/passport.php'));
