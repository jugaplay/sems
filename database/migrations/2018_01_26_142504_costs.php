<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Costs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id')->unsigned();
            $table->time('time_zone_start');
            $table->time('time_zone_end');
            $table->date('start_date');
            $table->date('end_date')->default('2999-12-31');
            $table->string('pirority')->nullable;
            $table->string('cost')->nullable;
            $table->string('type');
            $table->smallInteger('day_starts')->unsigned();
            $table->smallInteger('day_end')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');
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
        Schema::dropIfExists('costs');
    }
}
