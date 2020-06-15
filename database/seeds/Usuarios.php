<?php

use Illuminate\Database\Seeder;

class Usuarios extends Seeder
{
    public function run()
    {
            //1 USUARIO PRUEBA
        DB::table('usuarios')->insert([
        'id' => 7066868,
        'paterno' => 'ALEGRIA',
        'materno' => 'QUISPE',
        'nombre' => 'DAVID',
        'usuario' => 'DALEGRIA',
        'contraseña' => 'DALEGRIA',
        'cargo' => 'DESARROLLADOR',
        'departamento' => 'DGE',
        'estado' => 'activo',
        'fechaingreso' => '2020-01-01',
        'foto' => 'usuario.png',
        'permisos' => '',
        'licencias' => '', 
        'vacaciones' => '',
        ]);

        //1
        DB::table('usuarios')->insert([
        'id' => 8262202,
        'paterno' => 'ALIPAZ',
        'materno' => 'FLORES',
        'nombre' => 'CARLOS FERNANDO',
        'usuario' => 'CALIPAZ',
        'contraseña' => 'CALIPAZ',
        'cargo' => 'ANALISTA DE CONTABILIDAD Y PESUPUESTO',
        'departamento' => 'DAF',
        'estado' => 'activo',
        'fechaingreso' => '2020-01-01',
        'foto' => 'usuario.png',
        'permisos' => '',
        'licencias' => '', 
        'vacaciones' => '',
        ]);
        //2 
        DB::table('usuarios')->insert([
            'id' => 8325656,
            'paterno' => 'ARANA',
            'materno' => 'FIGUEREDO',
            'nombre' => 'DAYRA',
            'usuario' => 'DARANA',
            'contraseña' => 'DARANA',
            'cargo' => 'ANALISTA DE RECURSOS HUMANOS',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //3
        DB::table('usuarios')->insert([
            'id' => 6997278,
            'paterno' => 'CHOQUE',
            'materno' => 'FORONDA',
            'nombre' => 'MARCO ANTONIO',
            'usuario' => 'MCHOQUE',
            'contraseña' => 'MCHOQUE',
            'cargo' => 'TECNICO ADMINISTRATIVO FINANCIERO',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //4 
        DB::table('usuarios')->insert([
            'id' => 9877671,
            'paterno' => 'ESPINAL',
            'materno' => 'CALLIZAYA',
            'nombre' => 'JHOSELIN ARACELY',
            'usuario' => 'JESPINAL',
            'contraseña' => 'JESPINAL',
            'cargo' => 'AUXILIAR DE VENTANILLA UNIDAD II',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //5 9959200'Auxiliar de Ventanilla Unica I','DAF','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);
        DB::table('usuarios')->insert([
            'id' => 9959200,
            'paterno' => 'GUTIERREZ',
            'materno' => 'MANCEDA',
            'nombre' => 'YOSELIN',
            'usuario' => 'YGUTIERREZ',
            'contraseña' => 'YGUTIERREZ',
            'cargo' => 'AUXILIAR DE VENTANILLA UNIDAD I',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //6 6868301'Analista de Recaudaciones','DAF','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);

        DB::table('usuarios')->insert([
            'id' => 6868301,
            'paterno' => 'SALINAS',
            'materno' => 'MALDONADO',
            'nombre' => 'LIZ GABRIELA',
            'usuario' => 'LSALINAS',
            'contraseña' => 'LSALINAS',
            'cargo' => 'ANALISTA DE RECAUDACIONES',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //7 1241221,'Analista de Contrataciones','DAF','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);
        DB::table('usuarios')->insert([
            'id' => 1241221,
            'paterno' => 'VILLCA',
            'materno' => 'ALVINO',
            'nombre' => 'TEDDY HENRY',
            'usuario' => 'TVILLCA',
            'contraseña' => 'TVILLCA',
            'cargo' => 'ANALISTA DE CONTADURIA',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //8 ,','DIRECTOR ADMINISTRATIVO FINANCIERO','DAF','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);

        DB::table('usuarios')->insert([
            'id' => 178826,
            'paterno' => 'DEL CASTILLO',
            'materno' => 'LARA',
            'nombre' => 'JORGE ARMANDO',
            'usuario' => 'JDEL CASTILLO',
            'contraseña' => 'JDEL CASTILLO',
            'cargo' => 'DIRECTOR ADMINISTRATIVO FINANCIERO',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //9 ,CTOR JURIDICO','DJ','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);
        DB::table('usuarios')->insert([
            'id' => 4833822,
            'paterno' => 'BUITRAGO',
            'materno' => 'MEDRANO',
            'nombre' => 'MIGUEL ANGEL',
            'usuario' => 'MBUITRAGO',
            'contraseña' => 'MBUITRAGO',
            'cargo' => 'DIRECTOR JURIDICO',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);
        //10 

        DB::table('usuarios')->insert([
            'id' => 6171644,
            'paterno' => 'CARDENAS',
            'materno' => 'MENDOZA',
            'nombre' => 'PAOLA XIMENA',
            'usuario' => 'PCARDENAS',
            'contraseña' => 'PCARDENAS',
            'cargo' => 'ANALOISTA DE FISCALIZACION Y MONITOREO',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
            ]);

        //11 'Profesional de Atencion en Plataforma','DJ','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);

        DB::table('usuarios')->insert([
            'id' => 4301270,
            'paterno' => 'CARRERA',
            'materno' => 'OMONTE',
            'nombre' => 'WILLIANS JOSE',
            'usuario' => 'WCARRERA',
            'contraseña' => 'WCARRERA',
            'cargo' => 'PROFECIONAL DE ATENCION EN PLATAFORMA',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //12 'Notificador','DJ','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);

        DB::table('usuarios')->insert([
            'id' => 9210059,
            'paterno' => 'CHOQUE',
            'materno' => 'MARIN',
            'nombre' => 'JAIR',
            'usuario' => 'JCHOQUE',
            'contraseña' => 'JCHOQUE',
            'cargo' => 'NOTIFICADOR',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //13 4871766,Analista de procesos legales','DJ','activo','2019-01-01','usuario.png','permisos' => '','licencias' => '', 'vacaciones' => '',NULL,NULL);

        DB::table('usuarios')->insert([
            'id' => 4871766,
            'paterno' => 'DE LA CRUZ',
            'materno' => 'NOLASCO',
            'nombre' => 'KARINA NENIAN',
            'usuario' => 'KDE LA CRUZ',
            'contraseña' => 'KDE LA CRUZ',
            'cargo' => 'ANALISTA DE PROCESOS LEGALES',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //14
        DB::table('usuarios')->insert([
            'id' => 3656842,
            'paterno' => 'MARQUEZ',
            'materno' => 'CABEZAS',
            'nombre' => 'TANIA RITA',
            'usuario' => 'TMARQUEZ',
            'contraseña' => 'TMARQUEZ',
            'cargo' => 'ANALISTA LEGAL ADMINISTRATIVA',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //15
        DB::table('usuarios')->insert([
            'id' => 6094566,
            'paterno' => 'LOPEZ',
            'materno' => 'MAIDA',
            'nombre' => 'ALEJANDRA PAOLA',
            'usuario' => 'ALOPEZ',
            'contraseña' => 'ALOPEZ',
            'cargo' => 'JEFA DE GESTION JURIDICA',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //16
        DB::table('usuarios')->insert([
            'id' => 6127526,
            'paterno' => 'VARGAS',
            'materno' => 'IPORRE',
            'nombre' => 'JANNETT KARINA',
            'usuario' => 'JVARGAS',
            'contraseña' => 'JVARGAS',
            'cargo' => 'ANALISTA LEGAL',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' =>'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //17
             DB::table('usuarios')->insert([
            'id' => 4304927,
            'paterno' => 'ZENTENO',
            'materno' => 'MARTINEZ',
            'nombre' => 'SHIRLEY NAIR',
            'usuario' => 'SZENTENO',
            'contraseña' => 'SZENTENO',
            'cargo' => 'ANALISTA LEGAL',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        

        //------------DJ--------
        //18
        DB::table('usuarios')->insert([
            'id' => 8303727,
            'paterno' => 'SAAVEDRA',
            'materno' =>'ESCOBAR',
            'nombre' => 'LIZBETH MALENA',
            'usuario' => 'LSAAVEDRA',
            'contraseña' => 'LSAAVEDRA',
            'cargo' => 'APOYO A LA DIRECCION JURIDICA',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //19
        DB::table('usuarios')->insert([
            'id' => 4823034,
            'paterno' => 'ALIAGA',
            'materno' => 'FARFAN',
            'nombre' => 'MARIADE LOS ANGELES',
            'usuario' => 'MALIAGA',
            'contraseña' => 'MALIAGA',
            'cargo' => 'APOYO DIR. JURIDICA (SERVICIO)',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //20
        DB::table('usuarios')->insert([
            'id' => 4315051,
            'paterno' =>  'COLODRO',
            'materno' =>'AGUILERA' ,
            'nombre' => 'JOSETH SUSANA',
            'usuario' =>  'JCOLODRO',
            'contraseña' =>  'JCOLODRO',
            'cargo' => 'APOYO DIR. JURIDICA',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //21
        DB::table('usuarios')->insert([
            'id' => 6643130,
            'paterno' => 'FARFAN',
            'materno' =>'BERRIOS',
            'nombre' => 'ADAVANIA LENNY',
            'usuario' => 'AFARFAN',
            'contraseña' => 'AFARFAN',
            'cargo' => 'APOYO DIR. JURIDICA',
            'departamento' => 'DJ',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //--
        //22-------------DCF---------
        DB::table('usuarios')->insert([
            'id' => 1387262,
            'paterno' => 'CABALLERO',
            'materno' =>'LOPEZ',
            'nombre' => 'FRANCISCO',
            'usuario' => 'FCABALLERO',
            'contraseña' => 'FCABALLERO',
            'cargo' => 'ANALISTA DE CONTROL OPERATIVO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //23
        DB::table('usuarios')->insert([
            'id' => 6829175,
            'paterno' => 'CAMACHO',
            'materno' =>'RAMIREZ',
            'nombre' => 'SAUL BISMARK',
            'usuario' => 'SCAMACHO',
            'contraseña' => 'SCAMACHO',
            'cargo' => 'PROFESIONAL DE ATENCION EN PLATAFORMA',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //24
        DB::table('usuarios')->insert([
            'id' => 1111127,
            'paterno' => 'CERVANTES',
            'materno' =>'DONOSO',
            'nombre' => 'MARIA DEL PILAR',
            'usuario' => 'MCERVANTES',
            'contraseña' => 'MCERVANTES',
            'cargo' => 'DIRECTOR DE CONTROL Y FISCALIZACION',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //25
        DB::table('usuarios')->insert([
            'id' => 10034359,
            'paterno' => 'COLQUE',
            'materno' =>'LIMACHI',
            'nombre' => 'OMAR',
            'usuario' => 'OCOLQUE',
            'contraseña' => 'OCOLQUE',
            'cargo' => 'TÉCNICO DE ARCHIVO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //26
        DB::table('usuarios')->insert([
            'id' => 6088135,
            'paterno' => 'CRUZ',
            'materno' =>'QUILLA',
            'nombre' => 'EDWIN',
            'usuario' => 'ECRUZ',
            'contraseña' => 'ECRUZ',
            'cargo' => 'ANALISTA DE REGISTRO Y ARCHIVO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //27
        DB::table('usuarios')->insert([
            'id' => 4371772,
            'paterno' => 'PIZARRO',
            'materno' =>'MENDOZA',
            'nombre' => 'IVONE',
            'usuario' => 'IPIZARRO',
            'contraseña' => 'IPIZARRO',
            'cargo' => 'ANALISTA DE FISCALIZACIÓN Y MONITOREO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //28
        DB::table('usuarios')->insert([
            'id' => 9903944,
            'paterno' => 'POZO',
            'materno' =>'CALDERON',
            'nombre' => 'ANDREA MARIEL',
            'usuario' => 'APOZO',
            'contraseña' => 'APOZO',
            'cargo' => 'ANALISTA DE PERSONERÍAS JURÍDICAS Y REGISTRO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //29
        DB::table('usuarios')->insert([
            'id' => 6733878,
            'paterno' => 'RIOJA',
            'materno' =>'GEMIO',
            'nombre' => 'GUNNER FREDY',
            'usuario' => 'GRIOJA',
            'contraseña' => 'GRIOJA',
            'cargo' => 'ANALISTA DE FISCALIZACIÓN Y MONITOREO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        
        //--------------DGE--------------
        //30
        DB::table('usuarios')->insert([
            'id' => 8284288,
            'paterno' => 'DELGADO',
            'materno' => 'QUISPE',
            'nombre' => 'CRISTIAN EDWIN',
            'usuario' => 'CDELGADO',
            'contraseña' => 'CDELGADO',
            'cargo' => 'APOYO TECNICO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //31
        DB::table('usuarios')->insert([
            'id' => 8327326,
            'paterno' => 'MAMANI',
            'materno' => 'HUANCA',
            'nombre' => 'BEATRIZ',
            'usuario' => 'BMAMANI',
            'contraseña' => 'BMAMANI',
            'cargo' => 'APOYO TECNICO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //32
        DB::table('usuarios')->insert([
            'id' => 4299664,
            'paterno' => 'SARAVIA',
            'materno' => 'SALASHEROS',
            'nombre' => 'SERGIO RENE',
            'usuario' => 'SSARAVIA',
            'contraseña' => 'SSARAVIA',
            'cargo' => 'APOYO TECNICO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //33
        DB::table('usuarios')->insert([
            'id' => 6796129,
            'paterno' => 'TURPO',
            'materno' => 'CARVAJAL',
            'nombre' => 'VANESSA',
            'usuario' => 'VTURPO',
            'contraseña' => 'VTURPO',
            'cargo' => 'APOYO TECNICO',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //34
        DB::table('usuarios')->insert([
            'id' => 820766,
            'paterno' => 'FUENTES',
            'materno' => 'DAZA',
            'nombre' => 'FERNANDO',
            'usuario' => 'FFUENTES',
            'contraseña' =>'FFUENTES',
            'cargo' => 'DIRECTOR GENERAL EJECUTIVO',
            'departamento' => 'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //35
        DB::table('usuarios')->insert([
            'id' => 6748678,
            'paterno' => 'GISBERT',
            'materno' => 'TAMAYO',
            'nombre' => 'DIEGO GONZALO',
            'usuario' => 'DGISBERT',
            'contraseña' =>'DGISBERT',
            'cargo' => 'ANALISTA UTI',
            'departamento' => 'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //36
        DB::table('usuarios')->insert([
            'id' => 3662189,
            'paterno' => 'MAMANI',
            'materno' => 'GARCIA',
            'nombre' => 'MARCIA',
            'usuario' => 'MMAMANI',
            'contraseña' => 'MMAMANI',
            'cargo' => 'JEFA DE AUDITORIA INTERNA',
            'departamento' => 'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //37
        DB::table('usuarios')->insert([
            'id' => 3592339,
            'paterno' => 'LEON',
            'materno' => 'ZAMBRANA',
            'nombre' => 'CAROLA',
            'usuario' => 'CLEON',
            'contraseña' =>   'CLEON',
            'cargo' => 'RESPONSABLE DE PLANIFICACIÓN Y GESTIÓN',
            'departamento' => 'DGE',
            'estado' =>  'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //38
        DB::table('usuarios')->insert([
            'id' => 6988076,
            'paterno' => 'QUISPE',
            'materno' => 'YUJRA',
            'nombre' => 'WINSTON',
            'usuario' => 'WQUISPE',
            'contraseña' => 'WQUISPE',
            'cargo' => 'TÉCNICO DE DESARROLLO DE SISTEMAS',
            'departamento' =>     'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //39
        DB::table('usuarios')->insert([
            'id' => 6836717,
            'paterno' => 'CARDOZO',
            'materno' => 'SEGOVIA',
            'nombre' => 'ALEJANDRA PAOLA',
            'usuario' => 'ACARDOZO',
            'contraseña' =>'ACARDOZO',
            'cargo' => 'SECRETARIA EJECUTIVA',
            'departamento' => 'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //40
        DB::table('usuarios')->insert([
            'id' => 6951939,
            'paterno' => 'MACUCHAPI',
            'materno' => 'PARISACA',
            'nombre' => 'CARLOS',
            'usuario' => 'CMACUCHAPI',
            'contraseña' => 'CMACUCHAPI',
            'cargo' => 'APOYO AREA SISTEMAS',
            'departamento' => 'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //41
        DB::table('usuarios')->insert([
            'id' => 9982645,
            'paterno' => 'COLQUE',
            'materno' => 'BALBOA',
            'nombre' => 'OMAR FELIX',
            'usuario' => 'FCOLQUE',
            'contraseña' => 'FCOLQUE',
            'cargo' => 'TECNICO DAF',
            'departamento' => 'DAF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);

        //42
        DB::table('usuarios')->insert([
            'id' => 13116962,
            'paterno' => 'QUISPE',
            'materno' => 'APAZA',
            'nombre' => 'CRISTIAN',
            'usuario' => 'CQUISPE',
            'contraseña' => 'CQUISPE',
            'cargo' => 'TECNICO DGE',
            'departamento' => 'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);

        //43
        DB::table('usuarios')->insert([
            'id' => 4283197,
            'paterno' => 'ALIAGA',
            'materno' => 'MALDONADO',
            'nombre' => 'RICHARD ALDO',
            'usuario' => 'RALIAGA',
            'contraseña' => 'RALIAGA',
            'cargo' => 'TECNICO DCF',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //44
        DB::table('usuarios')->insert([
            'id' => 8353231,
            'paterno' => 'MENDOZA',
            'materno' => 'BERNAL',
            'nombre' => 'KESSIA STEFHANY',
            'usuario' => 'KMENDOZA',
            'contraseña' => 'KMENDOZA',
            'cargo' => 'ANALISTA LEGAL 6',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //45
        DB::table('usuarios')->insert([
            'id' => 8325788,
            'paterno' => 'APAZA',
            'materno' => 'HUAYLLUCO',
            'nombre' => 'JUAN ARIEL',
            'usuario' => 'JAPAZA',
            'contraseña' => 'JAPAZA',
            'cargo' => 'SERVICIO APOYO TÉCNICO (26990)',
            'departamento' => 'DCF',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        //46
        DB::table('usuarios')->insert([
            'id' => 6850448,
            'paterno' => 'TERAN',
            'materno' => 'FUNEZ',
            'nombre' => 'RICHARD YHAMIL',
            'usuario' => 'RTERAN',
            'contraseña' => 'RTERAN',
            'cargo' => 'TECNICO SISTEMAS',
            'departamento' => 'DGE',
            'estado' => 'activo',
            'fechaingreso' => '2020-01-01',
            'foto' => 'usuario.png',
            'permisos' => '',
            'licencias' => '', 
            'vacaciones' => '',
        ]);
        

    }
}
