<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\User;

use App\Actions\Auth\CreateToken;
use App\Actions\User\AuthUser;
use App\Exceptions\Database\RecordNotFoundException;
use App\Exceptions\Token\TokenNotCreatedException;
use App\Http\Controllers\V1\Base\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * user authentication
     * @response array{ message: "success", token: string }
     * @throws RecordNotFoundException
     * @throws TokenNotCreatedException
     * @
     */
    public function login(
        LoginRequest    $request,
        AuthUser        $authUser,
        CreateToken $createToken
    ): JsonResponse
    {
        $credentials = $request->validated();
        $user = $authUser($credentials);
        $token = $createToken($user, $user->email);

        return $this->successResponse([
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return $this->successResponse();
    }
}
