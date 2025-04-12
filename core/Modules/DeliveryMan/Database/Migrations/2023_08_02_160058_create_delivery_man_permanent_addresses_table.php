<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManPermanentAddressesTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_man_permanent_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_man_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->text('address_one')->nullable();
            $table->text('address_two')->nullable();
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans");
            $table->foreign("country_id")->references("id")->on("countries");
            $table->foreign("state_id")->references("id")->on("states");
            $table->foreign("city_id")->references("id")->on("cities");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_man_permanent_addresses');
    }
}
