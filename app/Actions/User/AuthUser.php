<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class AuthUser
{
    /**
     * @param mixed $data
     * @return User|UserNotFoundException
     * @throws UserNotFoundException
     */
    public function __invoke(mixed $data): User|UserNotFoundException
    {
        try {
            $user = User::query()
                ->where('email', $data['email'])
                ->get()
                ->first();
        } catch (QueryException $exception) {
            throw new UserNotFoundException($exception->getMessage());
        }

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new UserNotFoundException('User could not be found');
        }
        session()->put('user_id', $user->id);
        return $user;
    }
}
