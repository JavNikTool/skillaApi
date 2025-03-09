<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;

interface ResourceServiceInterface
{
    public function create(array $data): Model;
}
