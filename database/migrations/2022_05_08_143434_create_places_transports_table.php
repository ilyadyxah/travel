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
        Schema::create('places_transports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('transport_id');
            $table->timestamps();
            $table->foreign('place_id')
                ->references('id')
                ->on('places')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('transport_id')
                ->references('id')
                ->on('transports')
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
        Schema::dropIfExists('places_transports');
    }
};
