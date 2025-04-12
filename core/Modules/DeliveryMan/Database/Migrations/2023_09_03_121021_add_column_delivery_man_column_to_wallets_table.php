<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->unsignedBigInteger("delivery_man_id")->nullable();
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans");
        });
    }
};
