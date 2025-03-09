<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WorkerAssignedToOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Order $order;
    public int $workerId;

    /**
     * Create a new event instance.
     */
    public function __construct($order, $worker)
    {
        $this->order = $order;
        $this->workerId = $worker;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('worker.' . $this->workerId);
    }

    public function broadcastAs(): string
    {
        return 'worker.assigned.to.order';
    }

    public function broadcastWith(): array
    {
        return [
            'order_id' => $this->order->id,
            'worker_id' => $this->workerId,
            'message' => 'Вы назначены на заказ #' . $this->order->id,
        ];
    }
}
