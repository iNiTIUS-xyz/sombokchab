<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('refund_track_status_reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_track_id');
            $table->text('reason');
            $table->timestamps();
            $table->foreign("request_track_id")->references("id")->on("refund_request_tracks");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refund_track_status_reasons');
    }
};
