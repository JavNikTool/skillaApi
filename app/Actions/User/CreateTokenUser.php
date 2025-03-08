<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\Token\TokenNotCreatedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTokenUser
{
    /**
     * @param User $user
     * @return string|TokenNotCreatedException
     * @throws TokenNotCreatedException
     */
    public function __invoke(User $user): string|TokenNotCreatedException
    {
            $token = $user->createToken($user->email)->accessToken;

            if (!$token) {
                throw new TokenNotCreatedException('token could not be created');
            }

            return $token;
    }
}
