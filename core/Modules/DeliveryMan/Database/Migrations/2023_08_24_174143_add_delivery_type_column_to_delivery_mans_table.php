<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryTypeColumnToDeliveryMansTable extends Migration
{
    public function up(): void
    {
        Schema::table('delivery_mans', function (Blueprint $table) {
            $table->string("delivery_man_type")->nullable()->after("phone");
        });
    }
}
