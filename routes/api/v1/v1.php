<?php

declare(strict_types=1);

use App\Http\Controllers\V1\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('passport')->group(base_path('routes/api/v1/passport.php'));

Route::middleware(['guest', 'throttle:60'])->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:api', 'throttle:60'])->group(function () {
   Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
