<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InfringementCauses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infringement_causes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('detail')->nullable;
            $table->decimal('cost',13,2);
            $table->decimal('voluntary_cost,13,2');
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
        Schema::dropIfExists('infringement_causes');
    }
}
