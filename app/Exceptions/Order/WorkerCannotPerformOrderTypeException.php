<?php

namespace App\Exceptions\Order;

use App\Exceptions\Base\JsonException;
use Exception;

class WorkerCannotPerformOrderTypeException extends JsonException
{
    protected $code = 422;
}
