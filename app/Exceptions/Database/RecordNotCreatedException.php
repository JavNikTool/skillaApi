<?php

namespace App\Exceptions\Database;

use App\Exceptions\Base\JsonException;

class RecordNotCreatedException extends JsonException
{
    protected $code = 500;
}
