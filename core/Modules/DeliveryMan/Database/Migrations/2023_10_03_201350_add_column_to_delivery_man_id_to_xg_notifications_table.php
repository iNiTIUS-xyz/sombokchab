<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('x_g_notifications', function (Blueprint $table) {
            $table->unsignedBigInteger("delivery_man_id")->nullable()->after("vendor_id");
            $table->boolean("is_read_delivery_man")->default(false)->after("is_read_vendor");
            $table->foreign("delivery_man_id")->references("id")->on("delivery_mans");
        });
    }

    public function down(): void
    {
        Schema::table('x_g_notifications', function (Blueprint $table) {
            // First drop the foreign key
            $table->dropForeign(['delivery_man_id']);
            // Then drop the columns
            $table->dropColumn("delivery_man_id");
            $table->dropColumn("is_read_delivery_man");
        });
    }
};
