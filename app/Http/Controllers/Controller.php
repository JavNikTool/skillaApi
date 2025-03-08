<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function successResponse(array $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            ...$data
        ], $status);
    }

    protected function errorResponse(array $data = [], int $status = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            ...$data
        ], $status);
    }
}
