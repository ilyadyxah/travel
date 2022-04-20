<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id');
            $table->string('url');
            $table->timestamps();
            $table->foreign('place_id')
                ->references('id')
                ->on('places')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places_images');
    }
};
