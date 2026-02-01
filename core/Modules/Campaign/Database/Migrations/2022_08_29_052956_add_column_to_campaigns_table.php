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
        Schema::table('campaigns', function (Blueprint $table) {
            // Add admin_id if it doesn't exist
            if (!Schema::hasColumn('campaigns', 'admin_id')) {
                $table->unsignedBigInteger("admin_id")->nullable();
                $table->foreign("admin_id")->references("id")->on("admins");
            }

            // Add vendor_id if it doesn't exist
            if (!Schema::hasColumn('campaigns', 'vendor_id')) {
                $table->unsignedBigInteger("vendor_id")->nullable();
                $table->foreign("vendor_id")->references("id")->on("vendors");
            }

            // Add type if it doesn't exist
            if (!Schema::hasColumn('campaigns', 'type')) {
                $table->string("type")->nullable();
            }
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('campaigns', function (Blueprint $table) {
            if (Schema::hasColumn('campaigns', 'admin_id')) $table->dropColumn('admin_id');
            if (Schema::hasColumn('campaigns', 'vendor_id')) $table->dropColumn('vendor_id');
            if (Schema::hasColumn('campaigns', 'type')) $table->dropColumn('type');
        });

        Schema::enableForeignKeyConstraints();
    }
};
