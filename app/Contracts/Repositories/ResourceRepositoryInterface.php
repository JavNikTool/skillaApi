<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface ResourceRepositoryInterface
{
    public function create(array $data): Model;
}
