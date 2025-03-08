<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Oauth\PassportController;
use App\Http\Middleware\CheckTokenOwnership;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'throttle:60'])->group(function () {
    Route::post('token', [PassportController::class, 'issueToken']);
    Route::post('token/refresh', [PassportController::class, 'refreshToken']);
    Route::get('scopes', [PassportController::class, 'listScopes']);
});

Route::middleware(['auth:api', 'throttle:60'])->group(function () {
    Route::get('tokens', [PassportController::class, 'listTokens']);
    Route::delete('tokens/{token_id}', [PassportController::class, 'revokeToken'])
        ->middleware(CheckTokenOwnership::class);

    Route::get('clients', [PassportController::class, 'listClients']);
    Route::post('clients', [PassportController::class, 'createClient']);
    Route::put('clients/{client_id}', [PassportController::class, 'updateClient']);
    Route::delete('clients/{client_id}', [PassportController::class, 'deleteClient']);

    Route::get('personal-access-tokens', [PassportController::class, 'listPersonalAccessTokens']);
    Route::post('personal-access-tokens', [PassportController::class, 'createPersonalAccessToken']);
    Route::delete('personal-access-tokens/{token_id}', [PassportController::class, 'revokePersonalAccessToken']);
});

