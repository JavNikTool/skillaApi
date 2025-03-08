<?php

namespace App\Exceptions\Worker;

use App\Exceptions\Base\JsonException;
use Exception;

class FilterWorkersException extends JsonException
{
    protected $code = 422;
}
