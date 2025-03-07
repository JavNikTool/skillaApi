<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\User;

use App\Actions\User\CreateTokenUser;
use App\Actions\User\AuthUser;
use App\Exceptions\Token\TokenNotCreatedException;
use App\Exceptions\User\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @response array{ message: "success", token: string }
     * @throws UserNotFoundException
     * @throws TokenNotCreatedException
     * @
     */
    public function login(
        LoginRequest    $request,
        AuthUser        $authUser,
        CreateTokenUser $createTokenUser
    ): JsonResponse
    {
        $credentials = $request->validated();
        $user = $authUser($credentials);
        $token = $createTokenUser($user);

        return $this->successResponse([
            'token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse {
        $request->user()->token()->revoke();
        return $this->successResponse();
    }
}
