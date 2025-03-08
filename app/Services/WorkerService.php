<?php

namespace App\Services;

use App\Contracts\Services\WorkerServiceInterface;
use App\Exceptions\Worker\FilterWorkersException;
use App\Repositories\WorkerRepository;
use Illuminate\Support\Collection;

class WorkerService implements WorkerServiceInterface
{
    public function __construct(protected WorkerRepository $repository) {}

    /**
     * @throws FilterWorkersException
     */
    public function filterWorkersByOrderTypes(array $orderTypeIds): Collection
    {
        return $this->repository->filterByOrderTypes($orderTypeIds);
    }
}
