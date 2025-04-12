<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('live_chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("vendor_id")->references("id")->on("vendors");
        });
    }

    public function down(): void {
        Schema::dropIfExists('live_chats');
    }
};
