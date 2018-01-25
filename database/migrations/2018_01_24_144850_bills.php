<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('letter');
            $table->string('branch_office');
            $table->string('number');
            $table->string('document_type');
            $table->string('document_number');
            $table->decimal('net',13,2);
            $table->decimal('iva',13,2);
            $table->decimal('total',13,2);
            $table->date('date');
            $table->string('detail');
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
        Schema::dropIfExists('bills');
    }
}
