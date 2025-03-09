<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\WorkerServiceInterface;
use App\Exceptions\Database\DatabaseQueryException;
use App\Exceptions\Worker\FilterWorkersException;
use App\Repositories\WorkerRepository;
use Illuminate\Support\Collection;

class WorkerService implements WorkerServiceInterface
{
    public function __construct(protected WorkerRepository $repository)
    {
    }

    /**
     * @throws DatabaseQueryException
     */
    public function getWorkers(array $orderTypeIds): Collection
    {
        if (!$orderTypeIds) {
            return $this->repository->getWorkers($orderTypeIds);
        }

        return $this->repository->getWorkersExcludedForOrderTypes($orderTypeIds);
    }
}
