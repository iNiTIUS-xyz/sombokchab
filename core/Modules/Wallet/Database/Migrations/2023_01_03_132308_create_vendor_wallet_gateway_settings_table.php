<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vendor_wallet_gateway_settings', function (Blueprint $table) {
            $table->id();
            $table->integer("vendor_id")->nullable();
            $table->string('merchant_name')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('is_file')->nullable();
            $table->string('qr_file')->nullable();
            $table->string('gateway_qr_file')->nullable();
            $table->foreignId("vendor_wallet_gateway_id")->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor_wallet_gateway_settings');
    }
};
