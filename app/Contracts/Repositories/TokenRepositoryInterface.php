<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TokenRepositoryInterface
{
    public function revokeToken(string $token_id): void;

    public function listTokens(int $userId): array;
}
