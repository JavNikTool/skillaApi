<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\TokenRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Passport\Token;

class PassportTokenRepository implements TokenRepositoryInterface
{
    public function revokeToken(string $token_id): void {
        Token::query()
            ->find($token_id)
            ->revoke();
    }

    public function listTokens(int $userId): array
    {
        return Token::query()
            ->where('user_id', $userId)
            ->get()
            ->toArray();
    }
}
