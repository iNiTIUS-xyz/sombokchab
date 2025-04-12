<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryManRatingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_man_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_man_id');
            $table->unsignedBigInteger('user_id');
            $table->string('rating');
            $table->text('review')->nullable();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_man_ratings');
    }
}
