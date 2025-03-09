<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Base;

use App\Contracts\Services\ResourceServiceInterface;

class CrudController extends Controller
{
    protected ResourceServiceInterface $service;
}
