<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManIdentitiesTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_man_credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_man_id');
            $table->string('identity_type');
            $table->string('identity_number');
            $table->string('vehicle_type');
            $table->string('license_number')->nullable();
            $table->string('identity_image')->nullable();
            $table->string('license_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_man_credentials');
    }
}
