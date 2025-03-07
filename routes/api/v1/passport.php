<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;

Route::group([
    'namespace' => '\Laravel\Passport\Http\Controllers',
], function () {
    Route::post('token', [AccessTokenController::class, 'issueToken']);
    Route::post('token/refresh', [TransientTokenController::class, 'refresh']);
    Route::get('tokens', [AuthorizedAccessTokenController::class, 'forUser']);
    Route::delete('tokens/{token_id}', [AuthorizedAccessTokenController::class, 'destroy']);

    Route::get('clients', [ClientController::class, 'forUser']);
    Route::post('clients', [ClientController::class, 'store']);
    Route::put('clients/{client_id}', [ClientController::class, 'update']);
    Route::delete('clients/{client_id}', [ClientController::class, 'destroy']);

    Route::get('scopes', [ScopeController::class, 'all']);

    Route::get('personal-access-tokens', [PersonalAccessTokenController::class, 'forUser']);
    Route::post('personal-access-tokens', [PersonalAccessTokenController::class, 'store']);
    Route::delete('personal-access-tokens/{token_id}', [PersonalAccessTokenController::class, 'destroy']);
});
