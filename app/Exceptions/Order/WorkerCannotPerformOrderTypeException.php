<?php

declare(strict_types=1);

namespace App\Exceptions\Order;

use App\Exceptions\Base\JsonException;
use Exception;

class WorkerCannotPerformOrderTypeException extends JsonException
{
    protected $code = 422;
}
