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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('user_id')->default(1);
            $table->string('session_token')->nullable();
            $table->foreign('place_id')
                ->references('id')
                ->on('places')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
//            $table->foreign('user_id')
//                ->references('id')
//                ->on('users')
//                ->cascadeOnDelete()
//                ->cascadeOnUpdate();
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
        Schema::dropIfExists('likes');
    }
};
