<?php

namespace App\Repositories;

use App\Contracts\Repositories\WorkerRepositoryInterface;
use App\Exceptions\Worker\FilterWorkersException;
use App\Models\Worker;
use Illuminate\Support\Collection;

class WorkerRepository implements WorkerRepositoryInterface
{
    public function __construct(protected Worker $model){}


    /**
     * @throws FilterWorkersException
     */
    public function filterByOrderTypes(array $orderTypeIds): Collection
    {
        if (empty($orderTypeIds)) {
            throw new FilterWorkersException('Массив order_type_ids не может быть пустым.');
        }

        $excludedWorkerIds = $this->model->query()->whereHas('excludedOrderTypes', function ($query) use ($orderTypeIds) {
            $query->whereIn('order_type_id', $orderTypeIds);
        }, '=', count($orderTypeIds))->pluck('id');

        return $this->model->query()->whereNotIn('id', $excludedWorkerIds)->get();
    }
}
