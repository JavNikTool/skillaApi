<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\Database\RecordNotCreatedException;
use App\Models\User;
use Illuminate\Database\QueryException;

class RegisterUser
{
    /**
     * @param mixed $data
     * @return User|RecordNotCreatedException
     * @throws RecordNotCreatedException
     */
    public function handle(mixed $data): User|RecordNotCreatedException
    {
        try {
            $user = User::query()->create($data);
        } catch (QueryException $exception) {
            throw new RecordNotCreatedException($exception->getMessage());
        }

        return $user;
    }
}
