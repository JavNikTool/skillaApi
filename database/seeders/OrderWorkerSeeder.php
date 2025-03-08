<?php

namespace Database\Seeders;

use App\Models\OrderWorker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderWorker::factory()->count(10)->create();
    }
}
