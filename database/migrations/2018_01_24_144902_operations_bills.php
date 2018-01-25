<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OperationsBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operation_id')->unsigned();
            $table->integer('bill_id')->unsigned();
            $table->foreign('operation_id')->references('id')->on('operations');
            $table->foreign('bill_id')->references('id')->on('bills');
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
        Schema::dropIfExists('operations_bills');
    }
}
