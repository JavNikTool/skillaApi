<?php

namespace App\Services;

use App\Contracts\Repositories\ResourceRepositoryInterface;
use App\Contracts\Services\ResourceServiceInterface;
use App\Exceptions\Database\RecordNotCreatedException;
use App\Exceptions\Order\WorkerCannotPerformOrderTypeException;
use App\Models\Order;
use App\Models\Worker;
use App\Repositories\OrderRepository;

class OrderService implements ResourceServiceInterface
{
    public function __construct(public OrderRepository $repository){}

    /**
     * @throws RecordNotCreatedException
     */
    public function create(array $data): Order
    {
        return $this->repository->create($data);
    }

    /**
     * @throws WorkerCannotPerformOrderTypeException
     */
    public function assignWorker(Order $order, int $workerId): Order
    {
        $worker = Worker::query()->find($workerId);

        if(!$worker->canPerformOrderType($order->order_type_id)) {
            throw new WorkerCannotPerformOrderTypeException('Исполнитель отказался от этого типа заказа');
        }

        $this->repository->assignWorker($order, $workerId, $order->amount);

        return $order;
    }
}
