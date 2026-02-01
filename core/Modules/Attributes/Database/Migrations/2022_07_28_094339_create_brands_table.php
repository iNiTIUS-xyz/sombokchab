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
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("name_km")->nullable();
            $table->string("slug")->nullable();
            $table->unsignedBigInteger("image_id");
            $table->unsignedBigInteger("banner_id");
            $table->string("title")->nullable();
            $table->tinyText("description")->nullable();
            $table->tinyText("description_km")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("image_id")->references("id")->on("media_uploads");
            $table->foreign("banner_id")->references("id")->on("media_uploads");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
