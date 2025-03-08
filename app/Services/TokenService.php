<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\TokenRepositoryInterface;

class TokenService
{
    private TokenRepositoryInterface $tokenRepository;

    public function __construct(TokenRepositoryInterface $tokenRepository) {
        $this->tokenRepository = $tokenRepository;
    }

    public function revokeToken(string $token_id): void {
        $this->tokenRepository->revokeToken($token_id);
    }

    public function listTokens(int $userId): array {
        return $this->tokenRepository->listTokens($userId);
    }
}
