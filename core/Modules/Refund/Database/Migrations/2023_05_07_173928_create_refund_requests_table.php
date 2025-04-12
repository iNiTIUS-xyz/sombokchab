<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('refund_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->text('additional_information')->nullable();
            $table->unsignedBigInteger('preferred_option_id');
            $table->json('preferred_option_fields')->nullable();
            $table->string('status');
            $table->decimal("refund_fee")->nullable();
            $table->timestamps();
            $table->foreign("order_id")->references('id')->on("orders");
            $table->foreign("preferred_option_id")->references('id')->on("refund_preferred_options");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refund_requests');
    }
};
