<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_man_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_man_id');
            $table->unsignedBigInteger('order_id');
            $table->string('payment_type');
            $table->decimal('total_amount');
            $table->string('commission_type')->nullable();
            $table->float('commission_amount')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans");
            $table->foreign("order_id")->references("id")->on("orders");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_man_orders');
    }
}
