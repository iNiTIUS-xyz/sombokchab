<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('media_uploads', function (Blueprint $table) {
            $table->unsignedBigInteger("vendor_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('media_uploads', function (Blueprint $table) {
            $table->dropColumn("vendor_id");
        });
    }
};
