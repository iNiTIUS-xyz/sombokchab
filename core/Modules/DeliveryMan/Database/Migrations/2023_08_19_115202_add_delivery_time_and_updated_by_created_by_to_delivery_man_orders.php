<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryTimeAndUpdatedByCreatedByToDeliveryManOrders extends Migration
{
    public function up(): void
    {
        Schema::table('delivery_man_orders', function (Blueprint $table) {
            $table->dateTime("delivery_date")->after("order_id");
            $table->unsignedBigInteger("created_by")->after("created_at");
            $table->unsignedBigInteger("updated_by")->after("updated_at");
            $table->string("created_by_type")->after("created_by");
            $table->string("updated_by_type")->after("updated_by");
        });
    }

    public function down(): void
    {
        Schema::table('delivery_man_orders', function (Blueprint $table) {
            $table->dropColumn("delivery_date");
            $table->dropColumn("updated_by");
            $table->dropColumn("created_by");
            $table->dropColumn("created_by_type");
            $table->dropColumn("updated_by_type");
        });
    }
}
