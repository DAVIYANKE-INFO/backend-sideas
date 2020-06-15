<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('a');

            $table->integer('de')->unsigned();
            $table->foreign('de')->references('id')->on('usuarios');

            $table->string('motivon');
            $table->string('lugarn');
            $table->date('fechan');
            $table->time('horasalidan')->nullable();
            $table->time('horaretornon')->nullable();
            $table->boolean('firmasolicitanten');  
            $table->boolean('firmajefen');
            $table->boolean('firmarrhhn');
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
        Schema::dropIfExists('notificaciones');
    }
}
