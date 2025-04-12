<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vendor_bank_infos', function (Blueprint $table) {
            $table->boolean('is_varify')->nullable();
            $table->dateTime('varify_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_bank_infos', function (Blueprint $table) {
            $table->dropColumn('is_varify');
            $table->dropColumn('varify_at');
        });
    }
};
