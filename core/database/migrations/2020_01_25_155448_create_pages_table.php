<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->text('title_km')->nullable();
            $table->text('slug')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_tags_km')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_description_km')->nullable();
            $table->longText('content')->nullable();
            $table->longText('content_km')->nullable();
            $table->string('status')->nullable();
            $table->string('visibility')->nullable();
            $table->boolean('page_builder_status')->nullable();
            $table->boolean('navbar_category_dropdown_open')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
