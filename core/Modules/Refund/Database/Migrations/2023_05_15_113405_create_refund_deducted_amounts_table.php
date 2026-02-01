<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        if (!Schema::hasTable('refund_deducted_amounts')) {
            Schema::create('refund_deducted_amounts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('refund_request_track_id');
                $table->string('reason');
                $table->float('amount');
                $table->timestamps();
                $table->foreign("refund_request_track_id")->references("id")->on("refund_request_tracks");
            });
        }
    }
};
