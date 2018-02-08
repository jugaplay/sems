<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpaceReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier');
            $table->string('company');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('block_id')->unsigned();
            $table->string('latlng');
            $table->integer('operation_id')->nullable()->unsigned();
            $table->string('type'); //(container/load unload)
            $table->integer('size'); // (nro)
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('operation_id')->references('id')->on('operations');
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
        Schema::dropIfExists('space_reservations');
    }
}
