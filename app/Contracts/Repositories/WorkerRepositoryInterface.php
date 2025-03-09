<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface WorkerRepositoryInterface
{
    public function getWorkers(array $orderTypeIds): Collection;

    public function getWorkersExcludedForOrderTypes(array $orderTypeIds): Collection;
}
