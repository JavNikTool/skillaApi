<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Oauth;

use App\Http\Controllers\V1\Base\Controller;
use App\Services\TokenService;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    protected TokenService $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function listTokens(Request $request)
    {
        $tokens = $this->tokenService->listTokens($request->user()->id);
        return $this->successResponse(['tokens' => $tokens]);
    }

    public function revokeToken(Request $request, string $token_id)
    {
        $this->tokenService->revokeToken($token_id);
        return $this->successResponse(['message' => 'token revoked']);
    }

    public function issueToken()
    {
    }

    public function refreshToken()
    {
    }

    public function listClients()
    {
    }

    public function createClient()
    {
    }

    public function updateClient()
    {
    }

    public function deleteClient()
    {
    }

    public function listScopes()
    {
    }

    public function listPersonalAccessTokens()
    {
    }

    public function createPersonalAccessToken()
    {
    }

    public function revokePersonalAccessToken()
    {
    }
}
