<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\WorkerRepositoryInterface;
use App\Exceptions\Database\DatabaseQueryException;
use App\Exceptions\Worker\FilterWorkersException;
use App\Models\Worker;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class WorkerRepository implements WorkerRepositoryInterface
{
    public function __construct(protected Worker $model)
    {
    }


    /**
     * @throws DatabaseQueryException
     */
    public function getWorkers(array $orderTypeIds): Collection
    {
        try {
            return $this->model->query()
                ->orderByDesc('id')
                ->get();
        } catch (QueryException $exception) {
            throw new DatabaseQueryException();
        }
    }

    /**
     * @throws DatabaseQueryException
     */
    public function getWorkersExcludedForOrderTypes(array $orderTypeIds): Collection
    {
        try {
            $excludedWorkerIds = $this->model->query()
                ->whereHas('excludedOrderTypes', function ($query) use ($orderTypeIds) {
                    $query->whereIn('order_type_id', $orderTypeIds);
                }, '=', count($orderTypeIds))
                ->pluck('id');

            return $this->model->query()
                ->whereNotIn('id', $excludedWorkerIds)
                ->orderByDesc('id')
                ->get();
        } catch (QueryException $e) {
            throw new DatabaseQueryException();
        }
    }
}
