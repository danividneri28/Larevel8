<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table){
            $table->increments('idn');
            $table->date('fecha');
            $table->integer('monto');
            $table->integer('diast');

            $table->integer('ide')->unsigned();
            $table->foreign('ide')->references('ide')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nominas');
    }
};
