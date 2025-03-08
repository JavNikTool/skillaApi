<?php

namespace App\Repositories;

use App\Contracts\Repositories\ResourceRepositoryInterface;
use App\Exceptions\Database\RecordNotCreatedException;
use App\Models\Order;

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

    public function assignWorker(Order $order, int $workerId, float $amount): void
    {
        $order->workers()->attach($workerId, [
            'amount' => $amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order->update(['status' => 'назначен исполнитель']);
    }
}
