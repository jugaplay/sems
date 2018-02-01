<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OperationsBetweenWallets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_between_wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operation_id_1')->unsigned();
            $table->integer('operation_id_2')->unsigned();
            $table->foreign('operation_id_1')->references('id')->on('operations');
            $table->foreign('operation_id_2')->references('id')->on('operations');
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
        Schema::dropIfExists('operations_between_wallets');
    }
}
