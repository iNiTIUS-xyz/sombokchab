<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id")->nullable()->index();
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
            }

            if (Schema::hasColumn('orders', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
