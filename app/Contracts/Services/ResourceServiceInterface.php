<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;

interface ResourceServiceInterface
{
    public function create(array $data): Model;
}
