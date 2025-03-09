<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'second_name',
        'surname',
        'phone',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function excludedOrderTypes(): BelongsToMany
    {
        return $this->belongsToMany(OrderType::class, 'workers_ex_order_type');
    }

    public function canPerformOrderType(int $orderTypeId): bool
    {
        return !$this->excludedOrderTypes()->where('order_type_id', $orderTypeId)->exists();
    }

}
