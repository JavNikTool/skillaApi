<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Worker;

use App\Actions\Auth\CreateToken;
use App\Actions\Worker\AuthWorker;
use App\Exceptions\Database\RecordNotFoundException;
use App\Exceptions\Token\TokenNotCreatedException;
use App\Http\Controllers\V1\Base\Controller;
use App\Http\Requests\Worker\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * user authentication
     * @response array{ message: "success", token: string }
     * @throws RecordNotFoundException
     * @throws TokenNotCreatedException|RecordNotFoundException
     * @throws TokenNotCreatedException
     * @
     */
    public function login(
        LoginRequest $request,
        AuthWorker   $authWorker,
        CreateToken  $createToken
    ): JsonResponse
    {
        $credentials = $request->validated();
        $worker = $authWorker($credentials);
        $token = $createToken($worker, $worker->name);

        return $this->successResponse([
            'token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return $this->successResponse();
    }
}
