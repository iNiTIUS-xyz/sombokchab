<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_man_wallet_gateway_saved', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_man_id');
            $table->unsignedBigInteger('delivery_man_gateway_id');
            $table->longText('fields');
            $table->timestamps();
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans")->cascadeOnDelete();
        });
    }
};
