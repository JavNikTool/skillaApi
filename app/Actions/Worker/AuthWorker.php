<?php

declare(strict_types=1);

namespace App\Actions\Worker;

use App\Exceptions\Database\RecordNotFoundException;
use App\Models\Worker;
use Illuminate\Database\QueryException;

class AuthWorker
{
    /**
     * @param mixed $data
     * @return Worker|RecordNotFoundException
     * @throws RecordNotFoundException
     */
    public function __invoke(mixed $data): Worker|RecordNotFoundException
    {
        try {
            $worker = Worker::query()
                ->where('phone', $data['phone'])
                ->get()
                ->first();
        } catch (QueryException $exception) {
            throw new RecordNotFoundException($exception->getMessage());
        }

        if (!$worker) {
            throw new RecordNotFoundException('Исполнитель не найден.');
        }

        return $worker;
    }
}
