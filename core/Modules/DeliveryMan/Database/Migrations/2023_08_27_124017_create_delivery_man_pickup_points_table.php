<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManPickupPointsTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_man_pickup_points', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_number');
            $table->string('operating_hours');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // First, drop the foreign key from delivery_man_orders
        Schema::table('delivery_man_orders', function (Blueprint $table) {
            $table->dropForeign(['pickup_point_id']); // make sure this column name matches the FK
        });

        // Now drop the table
        Schema::dropIfExists('delivery_man_pickup_points');
    }
}
