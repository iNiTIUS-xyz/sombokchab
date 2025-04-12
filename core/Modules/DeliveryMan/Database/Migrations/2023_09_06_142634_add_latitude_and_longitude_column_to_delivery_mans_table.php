<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('delivery_mans', function (Blueprint $table) {
            $table->decimal("latitude", 10,8)->nullable();
            $table->decimal("longitude", 11,8)->nullable();
        });
    }
};
