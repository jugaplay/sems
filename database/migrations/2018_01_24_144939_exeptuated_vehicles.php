<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExeptuatedVehicles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exeptuated_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned();
            $table->string('detail');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('operation_id')->nullable()->unsigned();
            $table->string('type');// (neighbors/journalist/others)
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
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
        Schema::dropIfExists('exeptuated_vehicles');
    }
}
