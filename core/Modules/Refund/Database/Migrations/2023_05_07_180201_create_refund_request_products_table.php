<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('refund_request_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refund_request_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('variant_id')->nullable();
            $table->decimal('amount')->comment("this amount only for single quantity");
            $table->integer('quantity');
            $table->unsignedBigInteger("reason_id");
            $table->text('other_reason')->nullable();
            $table->timestamps();
            $table->foreign("refund_request_id")->references("id")->on("refund_requests");
            $table->foreign("product_id")->references("id")->on("products");
            $table->foreign("reason_id")->references("id")->on("refund_reasons");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refund_request_products');
    }
};
