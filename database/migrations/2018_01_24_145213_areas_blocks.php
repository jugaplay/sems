<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AreasBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('block_id')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->foreign('block_id')->references('id')->on('blocks');
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
        Schema::dropIfExists('areas_blocks');
    }
}
