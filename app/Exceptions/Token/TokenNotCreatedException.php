<?php

declare(strict_types=1);

namespace App\Exceptions\Token;

use App\Exceptions\Base\JsonException;

class TokenNotCreatedException extends JsonException
{
    protected $code = 500;
}
