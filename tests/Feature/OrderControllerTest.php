<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\Broadcast;
use Tests\Feature\Base\BaseTest;

class OrderControllerTest extends BaseTest
{

    public function test_user_can_create_order()
    {
        $order_type = OrderType::query()
            ->create([
                'name' => 'Погрузка/Разгрузка',
            ]);

        $response = $this->postJson( self::BASE_PATH . '/orders', [
            'title' => 'Test Order',
            'description' => 'This is a test order',
            'order_type_id' => $order_type->id,
            'partnership_id' => $this->user->partnership_id,
            'user_id' => $this->user->id,
            'date' => now()->format('Y-m-d'),
            'address' => 'Test Address',
            'amount' => 100.00,
            'status' => 'Создан',
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_update_order_status()
    {
        Broadcast::shouldReceive('event')->andReturnNull();

        $order = $this->getOrder();

        $response = $this->putJson(self::BASE_PATH . "/orders/{$order->id}/status", [
            'status' => 'завершен',
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_assign_worker_to_order()
    {
        Broadcast::shouldReceive('event')->andReturnNull();

        $order = $this->getOrder();
        $worker = Worker::factory()->create();

        $response = $this->postJson(self::BASE_PATH . "/orders/{$order->id}/assign-worker", [
            'worker_id' => $worker->id,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Исполнитель назначен на заказ']);
    }

    private function getOrder(): Order
    {
        $order_type = OrderType::query()
            ->create([
                'name' => 'Погрузка/Разгрузка',
            ]);

        return Order::factory()->create(['user_id' => $this->user->id, 'order_type_id' => $order_type->id]);
    }
}
