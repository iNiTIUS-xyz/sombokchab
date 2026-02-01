<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('refund_request_tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refund_request_id')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('updated_by')->index();
            $table->string('table');
            $table->timestamps();
            $table->foreign("refund_request_id")->references("id")->on("refund_requests");
        });
    }

    public function down(): void
    {

        // Disable FK checks to safely drop parent table
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('refund_request_tracks');
        Schema::enableForeignKeyConstraints();
    }
};
