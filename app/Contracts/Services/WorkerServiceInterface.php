<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface WorkerServiceInterface
{
    public function getWorkers(array $orderTypeIds): Collection;
}
