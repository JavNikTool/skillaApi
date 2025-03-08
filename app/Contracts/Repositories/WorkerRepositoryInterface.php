<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface WorkerRepositoryInterface
{
    public function filterByOrderTypes(array $orderTypeIds): Collection;
}
