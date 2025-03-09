<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Order;

use App\Exceptions\Database\DatabaseQueryException;
use App\Exceptions\Database\RecordNotCreatedException;
use App\Exceptions\Order\WorkerCannotPerformOrderTypeException;
use App\Http\Controllers\V1\Base\CrudController;
use App\Http\Requests\Order\AssignWorkerRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateStatusRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends CrudController
{
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws RecordNotCreatedException
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $order = $this->service->create($data);

        return $this->successResponse(['order_id' => $order->id], 201);
    }

    /**
     * @throws WorkerCannotPerformOrderTypeException
     * @throws DatabaseQueryException
     */
    public function assignWorker(AssignWorkerRequest $request, Order $order): JsonResponse
    {
        $workerId = $request->input('worker_id');
        $this->service->assignWorker($order, $workerId);

        return $this->successResponse([
            'message' => 'Исполнитель назначен на заказ',
            'order_id' => $order->id
        ]);
    }

    /**
     * @throws DatabaseQueryException
     */
    public function updateStatus(UpdateStatusRequest $request, Order $order): JsonResponse
    {
        $status = $request->input('status');

        $this->service->updateStatus($order, $status);

        return $this->successResponse([
            'message' => 'Статус заказа обновлен',
            'order_id' => $order->id,
            'new_status' => $order->status
        ]);
    }
}
