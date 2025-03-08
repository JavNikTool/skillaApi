<?php

declare(strict_types=1);

namespace App\Exceptions\Base;

use Exception;

class JsonException extends Exception
{
    public function render(): \Illuminate\Http\Response
    {
        return response([
            'status' => 'error',
            'data' => [
                'message' => $this->getMessage(),
                'type' => get_class($this),
                'code' => $this->getCode(),
            ],
        ], $this->getCode());
    }
}
