<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\User\UserNotCreatedException;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\QueryException;

class RegisterUser
{
    /**
     * @param mixed $data
     * @return User|UserNotCreatedException
     * @throws UserNotCreatedException
     */
    public function handle(mixed $data): User|UserNotCreatedException
    {
        try {
            $user = User::query()->create($data);
        } catch (QueryException $exception) {
            throw new UserNotCreatedException($exception->getMessage());
        }

        return $user;
    }
}
