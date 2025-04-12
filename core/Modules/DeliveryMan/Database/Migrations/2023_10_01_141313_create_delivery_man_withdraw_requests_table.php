<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_man_withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount')->nullable();
            $table->unsignedBigInteger('gateway_id');
            $table->unsignedBigInteger('delivery_man_id');
            $table->string('request_status');
            $table->text('gateway_fields');
            $table->text('note')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign("gateway_id")->references("id")->on("delivery_man_wallet_gateways");
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_man_withdraw_requests');
    }
};
