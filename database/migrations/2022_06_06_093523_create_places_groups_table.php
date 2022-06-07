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
        Schema::create('places_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('place_id');
            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('place_id')
                ->references('id')
                ->on('places')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
        Schema::table('places_groups', function (Blueprint $table) {
            $table->dropForeign(['group_id', 'place_id']);
            $table->dropIfExists('places_groups');
        });

    }
};
