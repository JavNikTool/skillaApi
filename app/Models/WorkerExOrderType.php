<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkerExOrderType extends Model
{
    use HasFactory;

    protected $table = 'workers_ex_order_type';

    protected $fillable = [
        'worker_id',
        'order_type_id',
    ];

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    public function orderType(): BelongsTo
    {
        return $this->belongsTo(OrderType::class);
    }
}
