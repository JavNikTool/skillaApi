<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Order;

use App\Exceptions\Database\RecordNotCreatedException;
use App\Exceptions\Order\WorkerCannotPerformOrderTypeException;
use App\Http\Controllers\V1\Base\CrudController;
use App\Http\Requests\Order\AssignWorkerRequest;
use App\Http\Requests\Order\StoreRequest;
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

        return $this->successResponse(['order_id' => $order->id]);
    }

    /**
     * @throws WorkerCannotPerformOrderTypeException
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
}
