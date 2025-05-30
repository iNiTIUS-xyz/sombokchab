<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_man_wallet_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('fields');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();
            $table->foreign("status_id")->references("id")->on("statuses");
        });
    }
};
