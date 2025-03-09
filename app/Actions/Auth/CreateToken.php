<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Exceptions\Token\TokenNotCreatedException;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateToken
{
    /**
     * @param Authenticatable $model
     * @param string $tokenName
     * @return string|TokenNotCreatedException
     * @throws TokenNotCreatedException
     */
    public function __invoke(Authenticatable $model, string $tokenName): string|TokenNotCreatedException
    {
        $token = $model->createToken($tokenName)->accessToken;

        if (!$token) {
            throw new TokenNotCreatedException('Токен не был создан.');
        }

        return $token;
    }
}
