<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function workersExcluded(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class, 'workers_ex_order_type');
    }
}
