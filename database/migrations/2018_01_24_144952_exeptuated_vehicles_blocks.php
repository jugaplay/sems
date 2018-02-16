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
        Schema::create('exeptuated_vehicle_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exeptuated_vehicle_id')->unsigned();
            $table->text('latlng');
            $table->foreign('exeptuated_vehicle_id')->references('id')->on('exeptuated_vehicles');
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
