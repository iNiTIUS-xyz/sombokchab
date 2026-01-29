<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdsToZonesTable extends Migration
{
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            if (!Schema::hasColumn('zones', 'city_ids')) {
                $table->json('city_ids')->nullable()->after('country_id');
            }

            if (Schema::hasColumn('zones', 'city_id')) {
                $table->dropColumn('city_id');
            }
        });
    }

    public function down()
    {
        Schema::table('zones', function (Blueprint $table) {
            if (!Schema::hasColumn('zones', 'city_id')) {
                $table->unsignedBigInteger('city_id')->nullable()->after('country_id');
            }

            if (Schema::hasColumn('zones', 'city_ids')) {
                $table->dropColumn('city_ids');
            }
        });
    }
}
