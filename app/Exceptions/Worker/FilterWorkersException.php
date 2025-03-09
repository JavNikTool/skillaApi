<?php

declare(strict_types=1);

namespace App\Exceptions\Worker;

use App\Exceptions\Base\JsonException;

class FilterWorkersException extends JsonException
{
    protected $code = 422;
}
