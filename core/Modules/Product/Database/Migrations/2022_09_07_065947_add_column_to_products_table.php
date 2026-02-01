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
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId("admin_id")->nullable()->constrained("admins");
            $table->foreignId("vendor_id")->nullable()->constrained("vendors");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            try {
                $table->dropForeign(['admin_id']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['vendor_id']);
            } catch (\Exception $e) {
            }

            if (Schema::hasColumn('products', 'admin_id') || Schema::hasColumn('products', 'vendor_id')) {
                $table->dropColumn(['admin_id', 'vendor_id']);
            }
        });
    }
};
