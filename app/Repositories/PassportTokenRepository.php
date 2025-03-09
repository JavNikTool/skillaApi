<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\TokenRepositoryInterface;
use App\Exceptions\Database\DatabaseQueryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Laravel\Passport\Token;

class PassportTokenRepository implements TokenRepositoryInterface
{
    /**
     * @throws DatabaseQueryException
     */
    public function revokeToken(string $token_id): void
    {
        try {
            Token::query()
                ->find($token_id)
                ->revoke();
        } catch (QueryException $e) {
            throw new DatabaseQueryException();
        }
    }

    /**
     * @throws DatabaseQueryException
     */
    public function listTokens(int $userId): array
    {
        try {
            return Token::query()
                ->where('user_id', $userId)
                ->get()
                ->toArray();
        } catch (QueryException $e) {
            throw new DatabaseQueryException();
        }
    }
}
