<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'date',
        'address',
        'amount',
        'status',
        'user_id',
        'partnership_id',
        'order_type_id',
    ];

    public function orderType(): BelongsTo
    {
        return $this->belongsTo(OrderType::class);
    }

    public function partnership(): BelongsTo
    {
        return $this->belongsTo(Partnership::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class);
    }
}
