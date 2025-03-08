<?php

namespace Database\Seeders;

use App\Models\Partnership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partnership::factory()->count(10)->create();
    }
}
