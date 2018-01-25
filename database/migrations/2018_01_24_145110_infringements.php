<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Infringements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infringements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate');
            $table->integer('user_id')->unsigned();
            $table->date('date');
            $table->string('situation'); // (before/saved/voluntary/judge/close)
            $table->integer('infringement_cause_id')->unsigned();
            $table->decimal('cost',13,2);
            $table->decimal('voluntary_cost',13,2);
            $table->string('voluntary_end_date');
            $table->string('close_date')->nullable();
            $table->decimal('close_cost',13,2)->nullable();
            $table->integer('operation_id')->nullable()->unsigned();
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('block_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('infringement_cause_id')->references('id')->on('infringement_causes');
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
        Schema::dropIfExists('infringements');
    }
}
