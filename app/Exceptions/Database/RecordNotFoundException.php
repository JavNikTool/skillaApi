<?php

namespace App\Exceptions\Database;

use App\Exceptions\Base\JsonException;

class RecordNotFoundException extends JsonException
{
    protected $code = 500;
}
