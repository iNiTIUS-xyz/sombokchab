<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->string('name_km')->nullable();
                $table->text('summary')->nullable();
                $table->text('summary_km')->nullable();
                $table->longText('description')->nullable();
                $table->longText('description_km')->nullable();
                $table->bigInteger('category_id')->nullable();
                $table->text('sub_category_id')->nullable();
                $table->string('image')->nullable();
                $table->text('product_image_gallery')->nullable();
                $table->double('price')->nullable();
                $table->double('sale_price')->nullable();
                $table->string('badge')->nullable();
                $table->string('status')->default('draft');
                $table->string('product_status')->nullable();
                $table->string('slug')->nullable();
                $table->longText('attributes')->nullable();
                $table->softDeletes();
                $table->timestamps();
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
        Schema::dropIfExists('products');
    }
}
