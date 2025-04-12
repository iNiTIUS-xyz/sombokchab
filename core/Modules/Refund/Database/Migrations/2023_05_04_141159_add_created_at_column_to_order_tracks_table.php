<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('order_tracks', function (Blueprint $table) {
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }
};
