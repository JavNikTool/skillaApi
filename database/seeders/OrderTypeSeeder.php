<?php

namespace Database\Seeders;

use App\Models\OrderType;
use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Погрузка/Разгрузка', 'Такелажные работы', 'Уборка'];

        foreach ($types as $type) {
            OrderType::query()
                ->create(['name' => $type]);
        }
    }
}
