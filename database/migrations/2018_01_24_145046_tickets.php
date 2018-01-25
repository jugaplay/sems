<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('plate');
            $table->string('time');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('block_id')->unsigned();
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('check')->nullable(); //(null/user_id que lo chequeo)
            $table->integer('operation_id')->nullable()->unsigned();
            $table->string('token');
            $table->string('type'); //(time/day)
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('block_id')->references('id')->on('blocks');
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
        Schema::dropIfExists('tickets');
    }
}
