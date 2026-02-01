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

        if (Schema::hasColumn('products', 'title') && !Schema::hasColumn('products', 'summary')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('title', 'summary');
            });
        }

        if (Schema::hasColumn('products', 'name') && !Schema::hasColumn('products', 'title')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('name', 'title');
            });
        }

        if (
            Schema::hasColumn('products', 'is_inventory_worn_able') &&
            !Schema::hasColumn('products', 'is_inventory_warn_able')
        ) {

            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('is_inventory_worn_able', 'is_inventory_warn_able');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasColumn('products', 'summary') && !Schema::hasColumn('products', 'title')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('summary', 'title');
            });
        }

        if (Schema::hasColumn('products', 'title') && !Schema::hasColumn('products', 'name')) {
            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('title', 'name');
            });
        }

        if (
            Schema::hasColumn('products', 'is_inventory_warn_able') &&
            !Schema::hasColumn('products', 'is_inventory_worn_able')
        ) {

            Schema::table('products', function (Blueprint $table) {
                $table->renameColumn('is_inventory_warn_able', 'is_inventory_worn_able');
            });
        }
    }
};
