<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Blocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('latitude_1');
            $table->string('longitude_1');
            $table->string('latitude_2');
            $table->string('longitude_2');
            $table->string('latitude_3');
            $table->string('longitude_3');
            $table->string('latitude_4');
            $table->string('longitude_4');
            $table->string('street');
            $table->integer('numeration_max');
            $table->integer('numeration_min');
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
        Schema::dropIfExists('blocks');
    }
}
