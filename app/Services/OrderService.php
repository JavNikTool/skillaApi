<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\ResourceServiceInterface;
use App\Events\OrderStatusUpdated;
use App\Events\WorkerAssignedToOrder;
use App\Exceptions\Database\DatabaseQueryException;
use App\Exceptions\Database\RecordNotCreatedException;
use App\Exceptions\Order\WorkerCannotPerformOrderTypeException;
use App\Models\Order;
use App\Models\Worker;
use App\Repositories\OrderRepository;

class OrderService implements ResourceServiceInterface
{
    public function __construct(public OrderRepository $repository)
    {
    }

    /**
     * @throws RecordNotCreatedException
     */
    public function create(array $data): Order
    {
        return $this->repository->create($data);
    }

    /**
     * @throws WorkerCannotPerformOrderTypeException|DatabaseQueryException
     */
    public function assignWorker(Order $order, int $workerId): void
    {
        $worker = Worker::query()->find($workerId);

        if (!$worker->canPerformOrderType($order->order_type_id)) {
            throw new WorkerCannotPerformOrderTypeException('Исполнитель отказался от этого типа заказа');
        }

        $this->repository->assignWorker($order, $workerId, $order->amount);
    }

    /**
     * @throws DatabaseQueryException
     */
    public function updateStatus(Order $order, string $status): void
    {
         $this->repository->updateStatus($order, $status);
    }
}
