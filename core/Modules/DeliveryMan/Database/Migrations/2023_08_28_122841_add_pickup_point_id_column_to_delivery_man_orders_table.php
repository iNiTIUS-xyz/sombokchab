<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('delivery_man_orders', function (Blueprint $table) {
            $table->unsignedBigInteger("pickup_point_id")->nullable()->after("order_id");
            $table->foreign("pickup_point_id")->references("id")->on("delivery_man_pickup_points");
        });
    }
};
