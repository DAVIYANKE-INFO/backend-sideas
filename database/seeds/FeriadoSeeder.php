<?php

use Illuminate\Database\Seeder;

class FeriadoSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('feriados')->insert([
        'id' => 1,
        'descripcion' => 'FERIADOS',
        'fechas' => '2020-01-01,2020-01-22,2020-02-24,2020-02-25,2020-04-10,2020-05-01,2020-06-11,2020-06-21,2020-08-06,2020-11-02,2020-12-25',
        'horas' => '',
        ]);
        DB::table('feriados')->insert([
        'id' => 2,
        'descripcion' => 'CORTES',
        'fechas' => '2020-01-21,2020-02-20',
        'horas' => '',
        ]);




        DB::table('feriados')->insert([
        'id' => 3,
        'descripcion' => 'INICIOS',
        'fechas' => '2020-01-01,2020-01-31,2020-02-03,2020-02-28,2020-03-02,2020-03-31,2020-04-01,2020-04-30,2020-05-01,2020-05-29,2020-06-01,2020-06-30,2020-07-01,2020-07-31,2020-08-03,2020-08-31,2020-09-01,2020-09-30,2020-10-01,2020-10-30,2020-11-02,2020-11-30,2020-12-01,2020-12-31',
        'horas' => '',
        ]);

        DB::table('feriados')->insert([
        'id' => 4,
        'descripcion' => 'CONTINUOS',
        'fechas' => '2020-02-21',
        'horas' => '',
        ]);




        DB::table('feriados')->insert([
        'id' => 21,
        'descripcion' => '',
        'fechas' => '',
        'horas' => '',
        ]);

        DB::table('feriados')->insert([
        'id' => 22,
        'descripcion' => '',
        'fechas' => '',
        'horas' => '',
        ]);
        DB::table('feriados')->insert([
        'id' => 23,
        'descripcion' => '',
        'fechas' => '',
        'horas' => '',
        ]);
        DB::table('feriados')->insert([
        'id' => 24,
        'descripcion' => '',
        'fechas' => '',
        'horas' => '',
        ]);

    }
}
