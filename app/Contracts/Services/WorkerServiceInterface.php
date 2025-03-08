<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface WorkerServiceInterface
{
    public function filterWorkersByOrderTypes(array $orderTypeIds): Collection;
}
