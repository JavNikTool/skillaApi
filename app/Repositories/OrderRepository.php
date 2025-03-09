<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ResourceRepositoryInterface;
use App\Events\OrderStatusUpdated;
use App\Events\WorkerAssignedToOrder;
use App\Exceptions\Database\DatabaseQueryException;
use App\Exceptions\Database\RecordNotCreatedException;
use App\Models\Order;
use Illuminate\Database\QueryException;

class OrderRepository implements ResourceRepositoryInterface
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * @throws RecordNotCreatedException
     */
    public function create(array $data): Order
    {
        try {
            return $this->model::query()->create($data);
        } catch (\Exception $e) {
            throw new RecordNotCreatedException($e->getMessage());
        }
    }

    /**
     * @throws DatabaseQueryException
     */
    public function assignWorker(Order $order, int $workerId, float $amount): void
    {
        try {
            $order->workers()->attach($workerId, [
                'amount' => $amount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $order->update(['status' => 'назначен исполнитель']);

            broadcast(New WorkerAssignedToOrder($order, $workerId));
        } catch (QueryException $e) {
            throw new DatabaseQueryException();
        }
    }

    /**
     * @throws DatabaseQueryException
     */
    public function updateStatus(Order $order, string $status): void
    {
        try {
            $order->update(['status' => $status]);

            broadcast(new OrderStatusUpdated($order, $status));
        } catch (QueryException $e) {
            throw new DatabaseQueryException();
        }
    }
}
