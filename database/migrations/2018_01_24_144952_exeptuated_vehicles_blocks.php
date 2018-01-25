<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExeptuatedVehiclesBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exeptuated_vehicles_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exeptuated_vehicle_id')->unsigned();
            $table->integer('block_id')->unsigned();
            $table->foreign('exeptuated_vehicle_id')->references('id')->on('exeptuated_vehicles');
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
        Schema::dropIfExists('exeptuated_vehicles_blocks');
    }
}
