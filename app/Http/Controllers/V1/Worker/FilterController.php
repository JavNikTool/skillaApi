<?php

namespace App\Http\Controllers\V1\Worker;

use App\Exceptions\Worker\FilterWorkersException;
use App\Http\Controllers\V1\Base\Controller;
use App\Http\Requests\Worker\FilterRequest;
use App\Services\WorkerService;
use Illuminate\Http\JsonResponse;

class FilterController extends Controller
{
    public function __construct(protected WorkerService $service) {}

    /**
     * @throws FilterWorkersException
     */
    public function filterByOrderTypes(FilterRequest $request): JsonResponse
    {
        $orderTypeIds = $request->input('order_type_ids', []);

        $workers = $this->service->filterWorkersByOrderTypes($orderTypeIds);

        return $this->successResponse(['workers' => $workers]);
    }
}
