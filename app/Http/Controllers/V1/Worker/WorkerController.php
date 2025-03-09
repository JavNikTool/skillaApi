<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Worker;

use App\Exceptions\Database\DatabaseQueryException;
use App\Exceptions\Worker\FilterWorkersException;
use App\Http\Controllers\V1\Base\Controller;
use App\Http\Requests\Worker\FilterRequest;
use App\Services\WorkerService;
use Illuminate\Http\JsonResponse;

class WorkerController extends Controller
{
    public function __construct(protected WorkerService $service)
    {
    }

    /**
     * @throws DatabaseQueryException
     */
    public function index(FilterRequest $request): JsonResponse
    {
        $orderTypeIds = $request->input('order_type_ids', []);

        $workers = $this->service->getWorkers($orderTypeIds);

        return $this->successResponse(['workers' => $workers]);
    }
}
