<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMobileSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobile_sliders', function (Blueprint $table) {
            $table->unsignedBigInteger("category")->nullable();
            $table->unsignedBigInteger("campaign")->nullable();
            $table->foreign("category")->references("id")->on("categories");
            $table->foreign("campaign")->references("id")->on("campaigns");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobile_sliders', function (Blueprint $table) {
            try {
                $table->dropForeign(['category']);
            } catch (\Exception $e) {
            }
            try {
                $table->dropForeign(['campaign']);
            } catch (\Exception $e) {
            }

            if (Schema::hasColumn('mobile_sliders', 'category')) {
                $table->dropColumn('category');
            }

            if (Schema::hasColumn('mobile_sliders', 'campaign')) {
                $table->dropColumn('campaign');
            }
        });
    }
}
