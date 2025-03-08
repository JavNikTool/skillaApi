<?php

namespace App\Exceptions\Token;

use App\Exceptions\Base\JsonException;

class TokenNotOwnedByUserException extends JsonException
{
    protected $code = 403;
}
