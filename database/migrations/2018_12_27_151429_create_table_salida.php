<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSalida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) 
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('cod_nombre')->unsigned();
            $table->foreign('cod_nombre')->references('id')->on('usuarios');

            $table->string('motivo');
            $table->string('lugar');
            $table->date('fecha');
            $table->time('horasalida')->nullable();
            $table->time('horaretorno')->nullable();
            $table->string('tipopapeleta');
            $table->boolean('firmasolicitante');  
            $table->boolean('firmajefe');
            $table->boolean('firmarrhh');
            $table->string('observacion')->nullable();
            $table->string('entregado')->nullable();
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
        Schema::dropIfExists('salidas');
    }
}
