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
        Schema::table('places', function (Blueprint $table) {
            $table->unsignedSmallInteger('distance')->nullable();
            $table->unsignedTinyInteger('complexity')->default(5);
            $table->unsignedInteger('cost')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('distance');
            $table->dropColumn('complexity');
            $table->dropColumn('cost');

        });
    }
};
