<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\Base\JsonException;

class UserNotCreatedException extends JsonException
{
    protected $code = 500;
}
