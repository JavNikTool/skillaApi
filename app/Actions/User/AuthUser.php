<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\Database\RecordNotFoundException;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class AuthUser
{
    /**
     * @param mixed $data
     * @return User|RecordNotFoundException
     * @throws RecordNotFoundException
     */
    public function __invoke(mixed $data): User|RecordNotFoundException
    {
        try {
            $user = User::query()
                ->where('email', $data['email'])
                ->get()
                ->first();
        } catch (QueryException $exception) {
            throw new RecordNotFoundException($exception->getMessage());
        }

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new RecordNotFoundException('User could not be found');
        }

        return $user;
    }
}
