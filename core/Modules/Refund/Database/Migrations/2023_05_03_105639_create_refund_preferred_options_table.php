<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('refund_preferred_options', function (Blueprint $table) {
            $table->id();
            $table->string("name")->index();
            $table->longText("fields")->nullable();
            $table->foreignId("status_id")->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refund_preferred_options');
    }
};
