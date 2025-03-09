<?php

declare(strict_types=1);

namespace App\Exceptions\Database;

use App\Exceptions\Base\JsonException;

class RecordNotFoundException extends JsonException
{
    protected $code = 500;
}
