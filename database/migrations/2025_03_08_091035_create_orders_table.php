<?php

use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OrderType::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Partnership::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->date('date');
            $table->string('address');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['Создан', 'назначен исполнитель', 'завершен'])->default('Создан');
            $table->timestamps();

            $table->index('order_type_id');
            $table->index('partnership_id');
            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
