<?php

declare(strict_types=1);

namespace App\Exceptions\Database;

use App\Exceptions\Base\JsonException;

class DatabaseQueryException extends JsonException
{
    protected $code = 500;

    protected $message = 'Ошибка при выполнении запроса к базе данных.';
}
