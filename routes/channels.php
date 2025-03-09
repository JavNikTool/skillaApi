<?php

declare(strict_types=1);

use App\Models\Worker;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('worker.{workerId}', function (Worker $worker, int $workerId) {
    return $worker->id === $workerId;
});
