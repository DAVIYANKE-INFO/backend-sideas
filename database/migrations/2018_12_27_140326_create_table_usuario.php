<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('paterno');
            $table->string('materno');
            $table->string('nombre');
            $table->string('usuario');
            $table->string('contraseña');
            $table->string('cargo');
            $table->string('departamento');
            $table->string('estado');
            $table->date('fechaingreso');
            $table->string('foto');
            $table->string('permisos',3000);
            $table->string('licencias',3000);
            $table->string('vacaciones',3000);
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
        Schema::drop('usuarios');
    }
}
