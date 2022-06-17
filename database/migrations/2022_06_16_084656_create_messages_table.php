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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->char('recipient_email')->nullable();
            $table->text('message');
            $table->string('link')->nullable();
            $table->timestamps();
            $table->foreignId('from_user_id')
                ->constrained('users');
            $table->foreignId('to_user_id')
                ->nullable()
                ->constrained('users');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['from_user_id', 'to_user_id']);
            $table->dropIfExists();
        });
    }
};
