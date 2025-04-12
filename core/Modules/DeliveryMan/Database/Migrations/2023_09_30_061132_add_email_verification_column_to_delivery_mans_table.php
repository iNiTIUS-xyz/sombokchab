<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('delivery_mans', function (Blueprint $table) {
            $table->string("verify_token")->nullable();
            $table->boolean("email_verified")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('delivery_mans', function (Blueprint $table) {
            $table->dropColumn("verify_token");
            $table->dropColumn("email_verified");
        });
    }
};
