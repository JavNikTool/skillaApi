<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\Base\JsonException;

class UserNotFoundException extends JsonException
{
    protected $code = 404;
}
