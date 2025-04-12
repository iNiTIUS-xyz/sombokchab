<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManZonesTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_man_zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->polygon('coordinates')->nullable();
            $table->tinyInteger('is_active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_man_zones');
    }
}
