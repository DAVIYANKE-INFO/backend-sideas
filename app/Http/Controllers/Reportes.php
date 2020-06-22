<?php
namespace App\Http\Controllers;
use App\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Feriado;
use App\Usuario;
use \stdClass;

class Reportes extends Controller
{
 
    public function diasferiadosyotros(Request $request)
    {
      $nume3=$request->identico;
      $feriadito=Feriado::where('id','=',$nume3)->first();  
      $feriadito->id=$nume3;
      $feriadito->descripcion=$request->nombre;
      $feriadito->fechas=$request->diaferia;
      $feriadito->horas=$request->horas;
      $feriadito->save();
    }

    public function diaspermisos(Request $request)
    {
      $id=$request->cii;
      $diaspermi=$request->rfechas;
      $usuariato=Usuario::find($id); 
      $usuariato->permisos=$diaspermi;
      $usuariato->save();
    }

    public function diaspermisosusuario(Request $request)
    {                                     
      $id=$request->cii;
      $usuario=Usuario::where('id','=',$id)->get();
      $usuariopermi=$usuario[0]['permisos'];
      return response()->json($usuariopermi);
    }

    public function diasvacaciones(Request $request)
    {
      $id=$request->cii;
      $diaspermi=$request->rfechas;
      $usuariato=Usuario::find($id); 
      $usuariato->vacaciones=$diaspermi;
      $usuariato->save();
    }

    public function diasvacacionesusuario(Request $request)
    {
      $id=$request->cii;
      $usuario=Usuario::where('id','=',$id)->get();
      $usuariopermi=$usuario[0]['vacaciones'];
      return response()->json($usuariopermi);
    }

    public function diass(Request $request)
    {
      $ferias=Feriado::all();
      return response()->json($ferias);
    }
      public function consultaestadisticas(Request $request)
    {
        $feriado=array();
        $uno=1;
        $xxx=Feriado::select('*')->where('id','=',$uno)->get();
        $feriadoss=$xxx[0]['fechas'];
        $array = explode(",", $feriadoss);

      for($t=0;$t<count($array);$t=$t+1)
      {
           $mi_array= explode("-", $array[$t]);
           array_push($feriado,intval($mi_array[2]) ,intval($mi_array[1]));
      }
      /******************VERIFICAMOS SI TIENE PERMISOS*************************/
       $cis=$request->codigousu;
       $permi_feria=Usuario::where('id','=',$cis)->get();
       $permi=$permi_feria[0]['permisos'];
       //echo "savid " . $permi;
       if($permi!="")
       {

       if(strlen($permi)<=12) //2020-12-15
       {
          $usuario_permisos=$permi;
          $mi_array_permi= explode("-", $usuario_permisos);
          array_push($feriado,intval($mi_array_permi[2]) ,intval($mi_array_permi[1]));
       }
       else
       {
          $usuario_permisos= explode(",", $permi);
          for($o=0;$o<count($usuario_permisos);$o++)
          {
               $mi_array_permi= explode("-", $usuario_permisos[$o]);
               array_push($feriado,intval($mi_array_permi[2]) ,intval($mi_array_permi[1]));
               //echo "--> " . $feriado[$t] . "\n";
          }
       }
     }
/******************FIN VERIFICAMOS SI TIENE PERMISOS*************************/

/******************VERIFICAMOS SI TIENE VACACIONES*************************/
       $cis_1=$request->codigousu;
       $vaca_feria=Usuario::where('id','=',$cis_1)->get();
       $vaca=$vaca_feria[0]['vacaciones'];
       //echo "savid " . $permi;
       if($vaca!="")
       {

       if(strlen($vaca)<=12) //2020-12-15
       {
          $usuario_vacaciones=$vaca;
          $mi_array_vaca= explode("-", $usuario_vacaciones);
          array_push($feriado,intval($mi_array_vaca[2]) ,intval($mi_array_vaca[1]));
       }
       else
       {
          $usuario_vacaciones= explode(",", $vaca);
          for($q=0;$q<count($usuario_vacaciones);$q++)
          {
               $mi_array_vaca= explode("-", $usuario_vacaciones[$q]);
               array_push($feriado,intval($mi_array_vaca[2]) ,intval($mi_array_vaca[1]));
               //echo "--> " . $feriado[$t] . "\n";
          }
       }
     }
/******************FIN VERIFICAMOS SI TIENE VACACIONES*************************/
      

        $dia=1;
        $mes=1;
        $año=2024;
        $froma = date('06:30:00');
        $toa = date('10:30:00');
        $fromc = date('10:30:01');
        $toc = date('13:30:00');
        $fromb = date('13:30:01');
        $tob = date('16:00:00');
        $fromd = date('16:30:01');
        $tod = date('22:59:59');


        $fromde = date('15:00:00');
        $tode = date('22:59:59');

        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        //echo "aqui llega--> " . $date;
        $hoy_año=substr($date, 0, 4);
        $hoy_mes=substr($date, 5, 2);
        $hoy_dia=substr($date, 8);
        $d_hoy=(int)$hoy_dia;
        $m_hoy=(int)$hoy_mes;
        $a_hoy=(int)$hoy_año;
        $cont_atrasos=0;
        $cont_puntuales=0;
        $cont_faltas=0;
        $cont_abandonos=0;
        $cont_permisos=0;

      if($request->yyy=="si")
      {
          $dos=2;
          $escoge=Feriado::select('*')->where('id','=',$dos)->get();
          $cortes=$escoge[0]['fechas'];
          $arrayo = explode(",", $cortes);
          $fechainicioreporte=$arrayo[0];
          $fechafinreporte=$date;
        }
      else
      {
          $fechainicioreporte=$request->xxx;
          $fechafinreporte=$request->zzz;
      }
       
       $fechainic=explode('"', $fechainicioreporte);
       $fechainic=explode('-', $fechainic[0]);
       $fechainicioreporte_año=$fechainic[0];
       $fechainicioreporte_mes=$fechainic[1];
       $fechainicioreporte_dia=$fechainic[2];

       $fechafin=explode('"', $fechafinreporte);
       $fechafin=explode('-', $fechafin[0]);
       $fechafinaleporte_año=$fechafin[0];
       $fechafinaleporte_mes=$fechafin[1];
       $fechafinaleporte_dia=$fechafin[2];



        $d_hoy=$fechafinaleporte_dia;
        $m_hoy=$fechafinaleporte_mes;


        $cedula=$request->codigousu;
        $fechaspermisos=Usuario::select('permisos')->where('id','=',$cedula)->get();
        //echo "vacas--->   " . $fechasvacaciones . "   hasta aqui llego" . "\n";
        $solano=explode(",", $fechaspermisos[0]['permisos']);
       // echo "sola--> " . $solano[1];
$json_de_permisos=[];
$mi_array_permisos=[];
        

        
        for($b=0;$b<count($solano);$b++)
        {


if(((date("Y-m-d H:i:s",strtotime($solano[$b])))>=(date("Y-m-d H:i:s",strtotime($fechainicioreporte_año . "-" . $fechainicioreporte_mes . "-" .$fechainicioreporte_dia))))&&((date("Y-m-d H:i:s",strtotime($solano[$b])))<=(date("Y-m-d H:i:s",strtotime($fechafinaleporte_año . "-" . $fechafinaleporte_mes . "-" .$fechafinaleporte_dia)))))
          {
              $mi_array_permisos=array('fecha'=>$solano[$b],'observacion'=>'..::SIN DESCRIPCIÓN::..','cantidad'=>1);
              array_push($json_de_permisos, $mi_array_permisos);
              $cont_permisos++;
          }
          
           
        }



/**INICIO GUARDA DATOS DE LOS MESES DE ENERO(1-31), FEBRERO(1-30) Y ASI HASTA DICIEMBRE EN LA VARIABLE x[]**/  
//------------testeado funcionando ---------------------------
$cont=1;
$contadordemes=1;
$bisiesto=0;
if($a_hoy%4==0)
{
	$bisiesto=1;
	//echo "ano bisiesto";
}
$todoslosdiasdelaño[0]=0;
$todoslosmesesdelaño[0]=0;
for($i=1;$i<=365+$bisiesto;$i++)
{
     $todoslosdiasdelaño[$i]=$cont;
     $todoslosmesesdelaño[$i]=$contadordemes;
    //echo $todoslosdiasdelaño[$i] . "\n";//print principal de este modulo
    //echo $todoslosdiasdelaño[$i] . " " . $todoslosmesesdelaño[$i] . "\n";//print principal de este modulo
    $cont++; 
    if(($i==31)||($i==59+$bisiesto)||($i==90+$bisiesto)||($i==120+$bisiesto)||($i==151+$bisiesto)||($i==181+$bisiesto)||($i==212+$bisiesto)||($i==243+$bisiesto)||($i==273+$bisiesto)||($i==304+$bisiesto)||($i==334+$bisiesto)||($i==365+$bisiesto))
    {
        $cont=1;
        $contadordemes++;
    }
   
}
/**FIN GUARDA DATOS DE LOS MESES DE ENERO(1-31), FEBRERO(1-30) Y ASI HASTA DICIEMBRE EN LA VARIABLE x[]**/  

//**********FECHA INGRESO A LA INSTITUCION*******//
$dia_ingreso=intval($fechainicioreporte_dia);
$mes_ingreso=intval($fechainicioreporte_mes);
$mesa=1;//inicia el contador de mes
//*******FIN FECHA INGRESO A LA INSTITUCION*******//

//************************************INICIO SEPARA 5 DIAS DE LA SEMANA Y DOS FINES DE SEMANA*********************************************//
if($a_hoy==2018)
{
	$contador=1;
}
if($a_hoy==2019)
{
	$contador=2;
}
if($a_hoy==2020)
{
	$contador=3;
}

$dos=0;
for ($i=1; $i <= 365; $i++) 
{
    if($contador<=5)
    {
      $contador_de_dias_semana=$contador;
      $contador++;  
    }
    else
    {
        $dos++;
        if($dos==2)
        {
            $contador=1;
            $dos=0;
        }
    }
  if(($todoslosdiasdelaño[$i]==$dia_ingreso)&&($mesa==$mes_ingreso))
  {
    $posicion_dia_ingreso=$i;
    $posicion_mes_ingreso=$todoslosmesesdelaño[$i];
    $copia=$mesa;
    break;
  }
  if(($i==(31))||($i==(59+$bisiesto))||($i==(90+$bisiesto))||($i==(120+$bisiesto))||($i==(151+$bisiesto))||($i==(181+$bisiesto))||($i==(212+$bisiesto))||($i==(243+$bisiesto))||($i==(273+$bisiesto))||($i==(304+$bisiesto))||($i==(334+$bisiesto))||($i==(365+$bisiesto)))
    {
      $mesa=$mesa+1	;
    }
}


//********************************************FIN SEPARA 5 DIAS DE LA SEMANA Y DOS FINES DE SEMANA*********************************************//

//*************************PARA OBTENER INDICES***********************//
for($t=1;$t<=count($todoslosdiasdelaño);$t++)
{
	//echo "SIIII " . $d_hoy . " = " . $todoslosdiasdelaño[$t] . " Y " . $m_hoy . " = " . $todoslosmesesdelaño[$t] ."\n";//print principal de este modulo
	if(($d_hoy==$todoslosdiasdelaño[$t])&&($m_hoy==$todoslosmesesdelaño[$t]))
	{
		$posicion_d_hoy=$t;
		$posicion_m_hoy=$t;
		break;
	}
}

//**********************FIN PARA OBTENER INDICES**********************//
$SUMA_SEGUNDOS_1=0;
$SUMA_SEGUNDOS_2=0;
$penalizacionpornomarcar=0;
$sumadesegundostotales=0;
$sumademinutostotales=0;
$sumadehorastotales=0;
$contador_de_faltas=0;
$contador=$contador_de_dias_semana;
$mi_array_atrasos=[];
$mi_array_faltas=[];
$mi_array_abandonos=[];
$dias_haberes_faltas=0;
$cont_haberes_faltas=0;
$json_de_atrasos=[];
$json_de_faltas=[];
$json_de_abandonos=[];
$destitucion='';
$datehoy =Carbon::now('America/La_Paz');
$horita=$datehoy->format('H:i:s');

for($k=$posicion_dia_ingreso;($k<=$posicion_d_hoy)&&($posicion_mes_ingreso<=$todoslosmesesdelaño[$posicion_m_hoy]);$k++)
{
  $copia_minutos=0;
  $copia_abandonos=0;
	if($contador<=5)
    {
        	$contador++;
          	$fecha=$a_hoy . "-" . $todoslosmesesdelaño[$k] . "-" . $todoslosdiasdelaño[$k]. "";
          //	echo "" . $fecha . "\n";//print fecha principal de este modulo

          	$haymarcasiones=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->get();


          	if($haymarcasiones=="[]")
          	{
          		//aqui no hay marcasiones
          		/***********VERIFICANDO SI ES DIA FERIADO************/
          		if(!($this->esferiado($todoslosdiasdelaño[$k],$todoslosmesesdelaño[$k],$feriado)))
	           	{
	           		$cont_faltas++;
                $cont_haberes_faltas++;
                if($cont_haberes_faltas==1)
                {
                  $dias_haberes_faltas=0.5;
                  $contador_de_faltas=$contador_de_faltas+$dias_haberes_faltas;
                }
                else
                {
                  if($cont_haberes_faltas==2)
                  {
                    $dias_haberes_faltas=1;
                    $contador_de_faltas=$contador_de_faltas+$dias_haberes_faltas;
                  }
                  else
                  {
                    if($cont_haberes_faltas>=3)
                    {
                      $dias_haberes_faltas=2;
                      $contador_de_faltas=$contador_de_faltas+$dias_haberes_faltas;
                      $destitucion=' Destitución';
                    }
                  }
                }

                $mi_array_faltas = array('fecha' => $fecha , 'sancion' => $dias_haberes_faltas . ' ' );
                array_push($json_de_faltas, $mi_array_faltas);  
	           	  //echo "NO " . "\n";
	           	}
	           	else
	           	{
	           		//echo "SI " . "\n" ;
	           	} 
          	}
          	else
          	{



              $date_hoy = Carbon::now();
              $date_hoy = $date_hoy->format('Y-m-d');
              //echo "aqui llega--> " . $date;
              $si_hoy_año=substr($date_hoy, 0, 4);
              $si_hoy_mes=substr($date_hoy, 5, 2);
              $si_hoy_dia=substr($date_hoy, 8);
              $si_d_hoy=(int)$si_hoy_dia;
              $si_m_hoy=(int)$si_hoy_mes;
              $si_a_hoy=(int)$si_hoy_año;


              

                  if(($si_a_hoy==$si_a_hoy)&&($si_m_hoy==$todoslosmesesdelaño[$k])&&($si_d_hoy==$todoslosdiasdelaño[$k]))
                  {


                      /***********************************************verifica continuo////////////////////////////////////////////*/
                      $d_continuos1=array();
                      $cuatrito=4;
                      $continuos1=Feriado::select('*')->where('id','=',$cuatrito)->get();
                      $diascontinuos1=$continuos1[0]['fechas'];
                      //echo ("total--> " . count($continuos1) . "\n");

                      if(strlen($diascontinuos1)<12)//2020-02-17
                      {
                        $d_continue1=$diascontinuos1;
                        array_push($d_continuos1, $d_continue1);
                      }
                      else
                      {
                        $d_continuos1=explode(",", $diascontinuos1);
                      }
                      
                      $banderita1=0;
                      for ($i=0; $i <count($d_continuos1) ; $i++) 
                      { 

   

                      $fecha_continua1=explode("-", $d_continuos1[$i]);

                        if(($si_a_hoy==$si_a_hoy)&&($fecha_continua1[1]==$todoslosmesesdelaño[$k])&&($fecha_continua1[2]==$todoslosdiasdelaño[$k]))
                        {
                          $banderita1=1;
                        }
                      }

                      if($banderita1==0)
                      {

                            $inicio='12:29:59';
                            $final='18:29:59';
                            $i=Carbon::parse($inicio)->toTimeString();
                            $f = Carbon::parse($final)->toTimeString();

                            $nueve=Carbon::parse('09:00:00')->toTimeString();
                            $doce=Carbon::parse('14:59:59')->toTimeString();
                            if(($horita>=$nueve)&&($horita<=$doce))
                            {
                                                        //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                        $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                        if($marco1=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                        }
                                                        else
                                                        {
                                                          $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                                            if($atrasos1=="[]")
                                                           {
                                                              $cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                                $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                                $HORA_1=$VALORHORA_1[0];
                                                                $MINUTOS_1=$VALORHORA_1[1];
                                                                $SEGUNDOS_1=$VALORHORA_1[2];
                                                                if($HORA_1==8)
                                                                {
                                                                  $sumademinutostotales=$sumademinutostotales+($MINUTOS_1-30);
                                                                  $copia_minutos=$MINUTOS_1-30;
                                                      
                                                                }
                                                                else
                                                                {
                                                                  if($HORA_1==9)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                                    $copia_minutos=30+$MINUTOS_1;
                      
                                                                  }
                                                                  if($HORA_1==10)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                                    $copia_minutos=90+$MINUTOS_1;
              
                                                                  }
                                                                }
                                                                $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                                $cont_atrasos++;
                                                               $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                               array_push($json_de_atrasos, $mi_array_atrasos);  

                                                           }
              
                                                        }
                              }
                              $cuatro=Carbon::parse('15:00:00')->toTimeString();
                              $dieciseis=Carbon::parse('18:29:59')->toTimeString();
                              if(($horita>=$cuatro)&&($horita<=$dieciseis))
                              {
                                                       //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                        $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                        if($marco1=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                            //echo "penalizacion por no marcar en la mañana--> " . $fecha . " " . $penalizacionpornomarcar . "\n";
                                                        }
                                                        else
                                                        {
                                                          $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                                            //echo("ATRASOS A--> " . $atrasos1 . "\n");
                                                            if($atrasos1=="[]")
                                                           {
                                                              $cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                                $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                                $HORA_1=$VALORHORA_1[0];
                                                                $MINUTOS_1=$VALORHORA_1[1];
                                                                $SEGUNDOS_1=$VALORHORA_1[2];
                                                                if($HORA_1==8)
                                                                {
                                                                  $sumademinutostotales=$sumademinutostotales+($MINUTOS_1-30);
                                                                  $copia_minutos=$MINUTOS_1-30;
                                                          
                                                                }
                                                                else
                                                                {
                                                                  if($HORA_1==9)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                                    $copia_minutos=30+$MINUTOS_1;
                                                                
                                                                  }
                                                                  if($HORA_1==10)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                                    $copia_minutos=90+$MINUTOS_1;
                                                                   
                                                                  }
                                                                }
                                                                $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                                $cont_atrasos++;
                                                               $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                               array_push($json_de_atrasos, $mi_array_atrasos);  

                                                           }
                                                 
                                                        }  

                                                        //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 14:30
                                                        $marco2=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->get();
                                                        if($marco2=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (tarde)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                        }
                                                        else
                                                        {  
                                                          

                                                          $atrasos2=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->orderBy('hora', 'asc')->take(1)->get()->where('hora','>=','14:36:00');
                                                          //echo("ATRASOS B--> " . $atrasos2 . "\n");

                                                          if($atrasos2=="[]")
                                                           {

                                                              $cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                                $VALORHORA_2=explode(':', $atrasos2[0]["hora"]);
                                                                $HORA_2=$VALORHORA_2[0];
                                                                $MINUTOS_2=$VALORHORA_2[1];
                                                                $SEGUNDOS_2=$VALORHORA_2[2];
                                                                if($HORA_2==14)
                                                                {
                                                                  $sumademinutostotales=$sumademinutostotales+($MINUTOS_2-30);
                                                                  $copia_minutos=$MINUTOS_2-30;
                                                                 
                                                                }
                                                                else
                                                                {
                                                                  if($HORA_2==15)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_2;
                                                                    $copia_minutos=30+$MINUTOS_2;
                                                           
                                                                  }
                                                                  if($HORA_2==16)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_2;
                                                                    $copia_minutos=90+$MINUTOS_2;
                                      
                                                                  }
                                                                }
                                                                $SUMA_SEGUNDOS_2=$SUMA_SEGUNDOS_2+$SEGUNDOS_2;
                                                                 // echo "suma segundos B " . $SUMA_SEGUNDOS_2 . "\n";
                                                                $cont_atrasos++;
                                                                $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos2[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_2 );
                                                               array_push($json_de_atrasos, $mi_array_atrasos);
                                                           }
                                                          
                                                         }








                                                          //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 12:30
                                                        $marco3=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->get();
                                                        if($marco3=="[]")
                                                        {
                                                            //aqui penalizacion
                                                          $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                        }
                                                        else
                                                        {

                                                           //del medio dia
                                                           $atrasos3=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','12:30:00');

                                                          if($atrasos3=="[]")
                                                           {
                                                            //  $cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                            $cont_abandonos++;
                                                            $copia_abandonos=1;
                                                            $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)", 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN DATOS:..', 'abandona'=> $copia_abandonos );
                                                               array_push($json_de_abandonos, $mi_array_abandonos);

                                                            }
                                                        }

                            }
                      }
                      else
                      {


                              //echo ("hasta aqui cañon" . "\n");
                          $nueve=Carbon::parse('09:00:00')->toTimeString();
                          $doce=Carbon::parse('15:59:59')->toTimeString();
                          if(($horita>=$nueve)&&($horita<=$doce))
                          {
                                                      //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                        $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                        if($marco1=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                           
                                                        }
                                                        else
                                                        {
                                                          $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:00:00');

                                                            //echo("ATRASOS A--> " . $atrasos1 . "\n");
                                                            if($atrasos1=="[]")
                                                           {
                                                              $cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                                $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                                $HORA_1=$VALORHORA_1[0];
                                                                $MINUTOS_1=$VALORHORA_1[1];
                                                                $SEGUNDOS_1=$VALORHORA_1[2];
                                                                if($HORA_1==8)
                                                                {
                                                                  $sumademinutostotales=$sumademinutostotales+$MINUTOS_1;
                                                                  $copia_minutos=$MINUTOS_1;
                                       
                                                                }
                                                                else
                                                                {
                                                                  if($HORA_1==9)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                                    $copia_minutos=30+$MINUTOS_1;

                                                                  }
                                                                  if($HORA_1==10)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                                    $copia_minutos=90+$MINUTOS_1;

                                                                  }
                                                                }
                                                                $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                                $cont_atrasos++;
                                                               $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                               array_push($json_de_atrasos, $mi_array_atrasos);  

                                                           }
 
                                                        }
                                     }
                   


                      }//fin pregunta si es continuo


                  }
                  else
                  {

                      $d_continuos=array();
                      $cuatrito=4;
                      $continuos=Feriado::select('*')->where('id','=',$cuatrito)->get();
                      $diascontinuos=$continuos[0]['fechas'];
                      if(strlen($diascontinuos)<12)//2020-02-17
                      {
                        $d_continue=$diascontinuos;
                        array_push($d_continuos, $d_continue);
                      }
                      else
                      {
                        $d_continuos=explode(",", $diascontinuos);
                      }
                      
                      $banderita=0;
  
                      for ($i=0; $i <count($d_continuos) ; $i++) 
                      { 

                        $fecha_continua=explode("-", $d_continuos[$i]);

                        if(($si_a_hoy==$si_a_hoy)&&($fecha_continua[1]==$todoslosmesesdelaño[$k])&&($fecha_continua[2]==$todoslosdiasdelaño[$k]))
                        {
                          $banderita=1;
                        }
                      }

                      if($banderita==0)
                      {

                                                      		//AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                        $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                        if($marco1=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);

                                                        }
                                                        else
                                                        {
                                                          $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                                            //echo("ATRASOS A--> " . $atrasos1 . "\n");
                                                            if($atrasos1=="[]")
                                                           {
                                                              $cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                                $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                                $HORA_1=$VALORHORA_1[0];
                                                                $MINUTOS_1=$VALORHORA_1[1];
                                                                $SEGUNDOS_1=$VALORHORA_1[2];
                                                                if($HORA_1==8)
                                                                {
                                                                  $sumademinutostotales=$sumademinutostotales+($MINUTOS_1-30);
                                                                  $copia_minutos=$MINUTOS_1-30;

                                                                }
                                                                else
                                                                {
                                                                  if($HORA_1==9)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                                    $copia_minutos=30+$MINUTOS_1;

                                                                  }
                                                                  if($HORA_1==10)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                                    $copia_minutos=90+$MINUTOS_1;
   
                                                                  }
                                                                }
                                                                $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                                $cont_atrasos++;
                                                               $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                               array_push($json_de_atrasos, $mi_array_atrasos);  

                                                           }
             
                                                        }





                                                          //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 14:30
                                                        $marco2=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->get();
                                                        if($marco2=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (tarde)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                        }
                                                        else
                                                        {  
                                                      		

                                                      		$atrasos2=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->orderBy('hora', 'asc')->take(1)->get()->where('hora','>=','14:36:00');

                                                      		if($atrasos2=="[]")
                                            		           {

                                            			          	$cont_puntuales++;
                                            		           }
                                            		           else
                                            		           {
                                                                $VALORHORA_2=explode(':', $atrasos2[0]["hora"]);
                                                                $HORA_2=$VALORHORA_2[0];
                                                                $MINUTOS_2=$VALORHORA_2[1];
                                                                $SEGUNDOS_2=$VALORHORA_2[2];
                                                                if($HORA_2==14)
                                                                {
                                                                  $sumademinutostotales=$sumademinutostotales+($MINUTOS_2-30);
                                                                  $copia_minutos=$MINUTOS_2-30;
                    
                                                                }
                                                                else
                                                                {
                                                                  if($HORA_2==15)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_2;
                                                                    $copia_minutos=30+$MINUTOS_2;
             
                                                                  }
                                                                  if($HORA_2==16)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_2;
                                                                    $copia_minutos=90+$MINUTOS_2;
    
                                                                  }
                                                                }
                                                                $SUMA_SEGUNDOS_2=$SUMA_SEGUNDOS_2+$SEGUNDOS_2;
                                                                $cont_atrasos++;
                                                                $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos2[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_2 );
                                                               array_push($json_de_atrasos, $mi_array_atrasos);
                                            		           }

                                                         }








                                                          //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 12:30
                                                        $marco3=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->get();
                                                        if($marco3=="[]")
                                                        {
                                                            //aqui penalizacion
                                                          $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                        }
                                                        else
                                                        {

                                            		           //del medio dia
                                            		           $atrasos3=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','12:30:00');

                                                      		if($atrasos3=="[]")
                                            		           {
                                            			          //	$cont_puntuales++;
                                            		           }
                                            		           else
                                            		           {
                                                            $cont_abandonos++;
                                                            $copia_abandonos=1;
                                                            $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)", 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN DATOS:..', 'abandona'=> $copia_abandonos );
                                                               array_push($json_de_abandonos, $mi_array_abandonos);

                                                              
                                                              
                                            		           }
                                            		
                                                        }





                                                          //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 18:30
                                                        $marco4=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromd, $tod))->get();
                                                        if($marco4=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (noche)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..','abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                        }
                                                        else
                                                        {
                                            		           //de la noche
                                            		           $atrasos4=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromd, $tod))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','18:30:00');


                                                      		if($atrasos4=="[]")
                                            		           {
                                            			          	//$cont_puntuales++;
                                            		           }
                                            		           else
                                            		           {
                                                              $cont_abandonos++;
                                                              $copia_abandonos=1;
                                                              $mi_array_abandonos = array('fecha' => $fecha . " (noche)" , 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN   DATOS:..', 'abandona'=> $copia_abandonos);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);

                                            		              	
                                            		           }
                                            		       
                                                        }




                                    }
                                    else
                                    {

                                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                        $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                        if($marco1=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                          
                                                        }
                                                        else
                                                        {
                                                          $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:00:01');

                                                            //echo("ATRASOS A--> " . $atrasos1 . "\n");
                                                            if($atrasos1=="[]")
                                                           {
                                                              $cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                                $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                                $HORA_1=$VALORHORA_1[0];
                                                                $MINUTOS_1=$VALORHORA_1[1];
                                                                $SEGUNDOS_1=$VALORHORA_1[2];
                                                                if($HORA_1==8)
                                                                {
                                                                  $sumademinutostotales=$sumademinutostotales+$MINUTOS_1;
                                                                  $copia_minutos=$MINUTOS_1;
                                                                
                                                                }
                                                                else
                                                                {
                                                                  if($HORA_1==9)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                                    $copia_minutos=30+$MINUTOS_1;
                                                               
                                                                  }
                                                                  if($HORA_1==10)
                                                                  {
                                                                    $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                                    $copia_minutos=90+$MINUTOS_1;
                                                              
                                                                  }
                                                                }
                                                                $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                              //echo "                 suma segundos A " . $SUMA_SEGUNDOS_1 . "\n";
                                                                $cont_atrasos++;
                                                               $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                               array_push($json_de_atrasos, $mi_array_atrasos);  

                                                           }
                                          
                                                        }




                                                          //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 16:00 horario continuo
                                                        $marco4=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromde, $tode))->get();
                                                        if($marco4=="[]")
                                                        {
                                                            //aqui penalizacion
                                                                $cont_abandonos++;
                                                                $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                                $mi_array_abandonos = array('fecha' => $fecha . " (noche)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..','abandona'=> 1);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);
                                                        }
                                                        else
                                                        {
                                                           //de la noche
                                                           $atrasos4=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromde, $tode))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','16:00:00');


                                                          if($atrasos4=="[]")
                                                           {
                                                              //$cont_puntuales++;
                                                           }
                                                           else
                                                           {
                                                              $cont_abandonos++;
                                                              $copia_abandonos=1;
                                                              $mi_array_abandonos = array('fecha' => $fecha . " (noche)" , 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN   DATOS:..', 'abandona'=> $copia_abandonos);
                                                               array_push($json_de_abandonos, $mi_array_abandonos);

                                                                
                                                           }

                                                        }


                                    }//fin verifica si es continuo el dia



                            }//fin if verifica si es hoy



        }
        //echo "\n";
            
    }
    else
    {
    //    echo "<br>";

        $dos++;
        if($dos==2)
        {
            $contador=1;
            $dos=0;
        }
    }
  
}

$divsegundos_entero=intdiv(($SUMA_SEGUNDOS_1 + $SUMA_SEGUNDOS_2),60 );
$divsegundos_modulo=($SUMA_SEGUNDOS_1 + $SUMA_SEGUNDOS_2)%60;



  $data = [$json_de_atrasos,['puntualidad' => $cont_puntuales, 'atrasos' => $cont_atrasos, 'permisos' => $cont_permisos,'abandonos'=>$cont_abandonos, 'faltas' => $cont_faltas, 'minstotales' => $sumademinutostotales, 'segundostotales' => ($SUMA_SEGUNDOS_1 + $SUMA_SEGUNDOS_2) ,'minutosseg' => $divsegundos_entero , 'segundos' => $divsegundos_modulo,'cont_faltas'=> $cont_faltas,'cont_permisos'=>$cont_permisos,'fecha_inicio'=> $dia_ingreso . " / " . $mes_ingreso . " / " . $a_hoy,'fecha_fin'=> $d_hoy . " / " . $m_hoy . " / " . $a_hoy],$json_de_faltas, $json_de_abandonos , $json_de_permisos];

         return response()->json($data);
    }

    public function mesesreportes(Request $request)
    {
      $datasets=array();
      $rangos=array();

      $tres=3;
      $iniciosmeses=Feriado::select('*')->where('id','=',$tres)->get();




      $ranguitos_1 = new stdClass();$ranguitos_1->ini='01'; $ranguitos_1->fin='31'; array_push($rangos, $ranguitos_1);
      $ranguitos_2 = new stdClass();$ranguitos_2->ini='03'; $ranguitos_2->fin='28'; array_push($rangos, $ranguitos_2);
      $ranguitos_3 = new stdClass();$ranguitos_3->ini='02'; $ranguitos_3->fin='31'; array_push($rangos, $ranguitos_3);
      $ranguitos_4 = new stdClass();$ranguitos_4->ini='01'; $ranguitos_4->fin='30'; array_push($rangos, $ranguitos_4);
      $ranguitos_5 = new stdClass();$ranguitos_5->ini='01'; $ranguitos_5->fin='29'; array_push($rangos, $ranguitos_5);
      $ranguitos_6 = new stdClass();$ranguitos_6->ini='01'; $ranguitos_6->fin='30'; array_push($rangos, $ranguitos_6);
      $ranguitos_7 = new stdClass();$ranguitos_7->ini='01'; $ranguitos_7->fin='31'; array_push($rangos, $ranguitos_7);
      $ranguitos_8 = new stdClass();$ranguitos_8->ini='03'; $ranguitos_8->fin='31'; array_push($rangos, $ranguitos_8);
      $ranguitos_9 = new stdClass();$ranguitos_9->ini='01'; $ranguitos_9->fin='30'; array_push($rangos, $ranguitos_9);
      $ranguitos_10 = new stdClass();$ranguitos_10->ini='01'; $ranguitos_10->fin='30'; array_push($rangos, $ranguitos_10);
      $ranguitos_11 = new stdClass();$ranguitos_11->ini='02'; $ranguitos_11->fin='30'; array_push($rangos, $ranguitos_11);
      $ranguitos_12 = new stdClass();$ranguitos_12->ini='01'; $ranguitos_12->fin='31'; array_push($rangos, $ranguitos_12);


      $mispuntuales=[];
      $misatrasos=[];
      $misfaltas=[];
      $mispermisos=[];
      $misabandonos=[];

      $dates = Carbon::now();
      $dates = $dates->format('Y-m-d');
      //echo "aqui llega--> " . $date;
      $año_actual=substr($dates, 0, 4);
      $mes_actual=substr($dates, 5, 2);
      $dia_actual=substr($dates, 8);

      $hoymes=(int)$mes_actual;
      $carnetide=$request->carnetsito;



    $tarea=Usuario::select('*')->where('id','=', $carnetide)->get();
    $fechaentro=$tarea[0]['fechaingreso'];

    $gg=explode("-", $fechaentro);
    $diaentrada=$gg[2];
    $mesentrada=$gg[1];
    $añoentrada=$gg[0];
    
    if(($diaentrada=='01')&&($mesentrada=='01'))
    {
      $dia_entrada='01';
      $mes_entrada=1;
      $año_entrada=2020;
    }
    else
    {
        $dia_entrada=$diaentrada . '';//dia;
        $mes_entrada=intval($mesentrada); //1;//2;
        $año_entrada=$añoentrada . '';//2020;
    }

    for($x=0;$x<$hoymes;$x++)
    {
                                  if($x+1<$mes_entrada)
                                  {
                                    array_push($mispuntuales, 0);
                                    array_push($misatrasos, 0);
                                    array_push($misfaltas, 0);
                                    array_push($mispermisos, 0);
                                    array_push($misabandonos, 0);
                                  }
                                  else
                                  {
                                            if(($x+1)==$mes_entrada)
                                              {
                                                if($x==($hoymes-1))
                                                {
                                                  $todomes=$this->funciondemeses($carnetide,($año_actual . "-" . $mes_actual . "-" . $dia_entrada),($año_actual . "-" . $mes_actual . "-" . $dia_actual));
                                                }
                                                else
                                                {
                                                  if($x<=9)
                                                  {
                                                    $todomes=$this->funciondemeses($carnetide,($año_actual . "-0" . ($x+1) . "-" . $dia_entrada),($año_actual . "-" . ($x+1) . "-" . $rangos[$x]->fin));
                                                  }
                                                  else
                                                  {
                                                    $todomes=$this->funciondemeses($carnetide,($año_actual . "-" . ($x+1) . "-" . $dia_entrada),($año_actual . "-" . ($x+1) . "-" . $rangos[$x]->fin));
                                                  }
                                                }
                                                //echo ("\n");
                                                $david=$todomes;
                                                //echo "LLEGO AL FIN " . $david[0];//[0]->puntualidad;
                                                  array_push($mispuntuales, $david[0]);
                                                  array_push($misatrasos, $david[1]);
                                                  array_push($misfaltas, $david[2]);
                                                  array_push($mispermisos, $david[3]);
                                                  array_push($misabandonos, $david[4]);
                                              }
                                              else
                                              {
                                                      if($x==($hoymes-1))
                                                      {
                                                        $todomes=$this->funciondemeses($carnetide,($año_actual . "-" . $mes_actual . "-" . $rangos[$x]->ini),($año_actual . "-" . $mes_actual . "-" . $dia_actual));
                                                      }
                                                      else
                                                      {
                                                        if($x<=9)
                                                        {
                                                          $todomes=$this->funciondemeses($carnetide,($año_actual . "-0" . ($x+1) . "-" . $rangos[$x]->ini),($año_actual . "-" . ($x+1) . "-" . $rangos[$x]->fin));
                                                        }
                                                        else
                                                        {
                                                          $todomes=$this->funciondemeses($carnetide,($año_actual . "-" . ($x+1) . "-" . $rangos[$x]->ini),($año_actual . "-" . ($x+1) . "-" . $rangos[$x]->fin));
                                                        }
                                                      }
                                                      //echo ("\n");
                                                      $david=$todomes;
                                                      //echo "LLEGO AL FIN " . $david[0];//[0]->puntualidad;
                                                        array_push($mispuntuales, $david[0]);
                                                        array_push($misatrasos, $david[1]);
                                                        array_push($misfaltas, $david[2]);
                                                        array_push($mispermisos, $david[3]);
                                                        array_push($misabandonos, $david[4]);

                                              }
                                  }
    }

      $elemento_1 = new stdClass(); $elemento_2 = new stdClass(); $elemento_3 = new stdClass(); $elemento_4 = new stdClass(); $elemento_5 = new stdClass();

          $elemento_1->datitos=$mispuntuales; array_push($datasets, $elemento_1);
          $elemento_2->datitos=$misatrasos; array_push($datasets, $elemento_2);
          $elemento_3->datitos=$misfaltas; array_push($datasets, $elemento_3); 
          $elemento_4->datitos=$mispermisos; array_push($datasets, $elemento_4); 
          $elemento_5->datitos=$misabandonos; array_push($datasets, $elemento_5);  




      return response()->json($datasets);
    
    }





  public function funciondemeses($ci_persona,$mes_limit_inferior,$mes_limit_superior)
    {


        $feriado=array();
        $uno=1;
        $xxx=Feriado::select('*')->where('id','=',$uno)->get();
        $feriadoss=$xxx[0]['fechas'];
        //echo "feriados--> " . $xxx[0]['fechas'];
        $array = explode(",", $feriadoss);

      for($t=0;$t<count($array);$t=$t+1)
      {
           $mi_array= explode("-", $array[$t]);
           array_push($feriado,intval($mi_array[2]) ,intval($mi_array[1]));
           //echo "--> " . $feriado[$t] . "\n";
      }


/******************VERIFICAMOS SI TIENE PERMISOS*************************/
       $cis=$ci_persona;//$request->codigousu;
       $permi_feria=Usuario::where('id','=',$cis)->get();
       $permi=$permi_feria[0]['permisos'];
      // echo "permisos " . $permi;
       if($permi!="")
       {

       if(strlen($permi)<=12) //2020-12-15
       {
          $usuario_permisos=$permi;
          $mi_array_permi= explode("-", $usuario_permisos);
          array_push($feriado,intval($mi_array_permi[2]) ,intval($mi_array_permi[1]));
       }
       else
       {
          $usuario_permisos= explode(",", $permi);
          for($o=0;$o<count($usuario_permisos);$o++)
          {
               $mi_array_permi= explode("-", $usuario_permisos[$o]);
               array_push($feriado,intval($mi_array_permi[2]) ,intval($mi_array_permi[1]));
               //echo "--> " . $feriado[$t] . "\n";
          }
       }
     }
/******************FIN VERIFICAMOS SI TIENE PERMISOS*************************/



/******************VERIFICAMOS SI TIENE VACACIONES*************************/
       $cis_1=$ci_persona;
       $vaca_feria=Usuario::where('id','=',$cis_1)->get();
       $vaca=$vaca_feria[0]['vacaciones'];
       //echo "savid " . $permi;
       if($vaca!="")
       {

       if(strlen($vaca)<=12) //2020-12-15
       {
          $usuario_vacaciones=$vaca;
          $mi_array_vaca= explode("-", $usuario_vacaciones);
          array_push($feriado,intval($mi_array_vaca[2]) ,intval($mi_array_vaca[1]));
       }
       else
       {
          $usuario_vacaciones= explode(",", $vaca);
          for($q=0;$q<count($usuario_vacaciones);$q++)
          {
               $mi_array_vaca= explode("-", $usuario_vacaciones[$q]);
               array_push($feriado,intval($mi_array_vaca[2]) ,intval($mi_array_vaca[1]));
               //echo "--> " . $feriado[$t] . "\n";
          }
       }
     }
/******************FIN VERIFICAMOS SI TIENE VACACIONES*************************/

        $froma = date('06:30:00');
        $toa = date('10:30:00');
        $fromc = date('10:30:01');
        $toc = date('13:30:00');
        $fromb = date('13:30:01');
        $tob = date('16:00:00');
        $fromd = date('16:30:01');
        $tod = date('22:59:59');


        $fromde = date('15:00:00');
        $tode = date('22:59:59');

        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        //echo "aqui llega--> " . $date;
        $hoy_año=substr($date, 0, 4);
        $hoy_mes=substr($date, 5, 2);
        $hoy_dia=substr($date, 8);
        $d_hoy=(int)$hoy_dia;
        $m_hoy=(int)$hoy_mes;
        $a_hoy=(int)$hoy_año;
        $cont_atrasos=0;
        $cont_puntuales=0;
        $cont_faltas=0;
        $cont_abandonos=0;
        $cont_permisos=0;


      $fechainicioreporte=$mes_limit_inferior;
      $fechafinreporte=$mes_limit_superior;
       
       $fechainic=explode('"', $fechainicioreporte);
       $fechainic=explode('-', $fechainic[0]);
       $fechainicioreporte_año=$fechainic[0];
       $fechainicioreporte_mes=$fechainic[1];
       $fechainicioreporte_dia=$fechainic[2];

       $fechafin=explode('"', $fechafinreporte);
       $fechafin=explode('-', $fechafin[0]);
       $fechafinaleporte_año=$fechafin[0];
       $fechafinaleporte_mes=$fechafin[1];
       $fechafinaleporte_dia=$fechafin[2];



       $d_hoy=$fechafinaleporte_dia;
       $m_hoy=(int)$fechafinaleporte_mes;




        $cedula=$ci_persona;
        $fechaspermisos=Usuario::select('permisos')->where('id','=',$cedula)->get();
        $solano=explode(",", $fechaspermisos[0]['permisos']);
        for($b=0;$b<count($solano);$b++)
        {


if(((date("Y-m-d H:i:s",strtotime($solano[$b])))>=(date("Y-m-d H:i:s",strtotime($fechainicioreporte_año . "-" . $fechainicioreporte_mes . "-" .$fechainicioreporte_dia))))&&((date("Y-m-d H:i:s",strtotime($solano[$b])))<=(date("Y-m-d H:i:s",strtotime($fechafinaleporte_año . "-" . $fechafinaleporte_mes . "-" .$fechafinaleporte_dia)))))
          {
              
              $cont_permisos++;
          }
          
           
        }


       /**INICIO GUARDA DATOS DE LOS MESES DE ENERO(1-31), FEBRERO(1-30) Y ASI HASTA DICIEMBRE EN LA VARIABLE x[]**/  
//------------testeado funcionando ---------------------------
$cont=1;
$contadordemes=1;
$bisiesto=0;
if($a_hoy%4==0)
{
  $bisiesto=1;
  //echo "ano bisiesto";
}
$todoslosdiasdelaño[0]=0;
$todoslosmesesdelaño[0]=0;
for($i=1;$i<=365+$bisiesto;$i++)
{
     $todoslosdiasdelaño[$i]=$cont;
     $todoslosmesesdelaño[$i]=$contadordemes;
    //echo $todoslosdiasdelaño[$i] . "\n";//print principal de este modulo
    //echo $todoslosdiasdelaño[$i] . " " . $todoslosmesesdelaño[$i] . "\n";//print principal de este modulo
    $cont++; 
    if(($i==31)||($i==59+$bisiesto)||($i==90+$bisiesto)||($i==120+$bisiesto)||($i==151+$bisiesto)||($i==181+$bisiesto)||($i==212+$bisiesto)||($i==243+$bisiesto)||($i==273+$bisiesto)||($i==304+$bisiesto)||($i==334+$bisiesto)||($i==365+$bisiesto))
    {
        $cont=1;
        $contadordemes++;
    }
   
}

/**FIN GUARDA DATOS DE LOS MESES DE ENERO(1-31), FEBRERO(1-30) Y ASI HASTA DICIEMBRE EN LA VARIABLE x[]**/  
/**********FECHA INGRESO A LA INSTITUCION*******/
$dia_ingreso=intval($fechainicioreporte_dia);
$mes_ingreso=intval($fechainicioreporte_mes);
$mesa=1;//inicia el contador de mes
//*******FIN FECHA INGRESO A LA INSTITUCION*******//

//************************************INICIO SEPARA 5 DIAS DE LA SEMANA Y DOS FINES DE SEMANA*********************************************//
if($a_hoy==2018)
{
  $contador=1;
}
if($a_hoy==2019)
{
  $contador=2;
}
if($a_hoy==2020)
{
  $contador=3;
}


$dos=0;
for ($i=1; $i <= 365; $i++) 
{
    if($contador<=5)
    {
      $contador_de_dias_semana=$contador;
      $contador++;  
    }
    else
    {
        $dos++;
        if($dos==2)
        {
            $contador=1;
            $dos=0;
        }
    }
  if(($todoslosdiasdelaño[$i]==$dia_ingreso)&&($mesa==$mes_ingreso))
  {
    $posicion_dia_ingreso=$i;
    $posicion_mes_ingreso=$todoslosmesesdelaño[$i];
    $copia=$mesa;
    break;
  }
  if(($i==(31))||($i==(59+$bisiesto))||($i==(90+$bisiesto))||($i==(120+$bisiesto))||($i==(151+$bisiesto))||($i==(181+$bisiesto))||($i==(212+$bisiesto))||($i==(243+$bisiesto))||($i==(273+$bisiesto))||($i==(304+$bisiesto))||($i==(334+$bisiesto))||($i==(365+$bisiesto)))
    {
      $mesa=$mesa+1 ;
    }
}


//********************************************FIN SEPARA 5 DIAS DE LA SEMANA Y DOS FINES DE SEMANA*********************************************//

//*************************PARA OBTENER INDICES***********************//
for($t=1;$t<count($todoslosdiasdelaño);$t++)
{
  
  
  if(($d_hoy==$todoslosdiasdelaño[$t])&&($m_hoy==$todoslosmesesdelaño[$t]))
  {
    $posicion_d_hoy=$t;
    $posicion_m_hoy=$t;
    break;
  }
}


//**********************FIN PARA OBTENER INDICES**********************//

//echo "llllllegga";
$contador=$contador_de_dias_semana;


$datehoy =Carbon::now('America/La_Paz');
$horita=$datehoy->format('H:i:s');

for($k=$posicion_dia_ingreso;($k<=$posicion_d_hoy)&&($posicion_mes_ingreso<=$todoslosmesesdelaño[$posicion_m_hoy]);$k++)
{

    if($contador<=5)
    {
          $contador++;
            $fecha=$a_hoy . "-" . $todoslosmesesdelaño[$k] . "-" . $todoslosdiasdelaño[$k]. "";
      
            $haymarcasiones=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->get();
      

            if($haymarcasiones=="[]")
            {
              
              /***********VERIFICANDO SI ES DIA FERIADO************/
              if(!($this->esferiado($todoslosdiasdelaño[$k],$todoslosmesesdelaño[$k],$feriado)))
              {
                $cont_faltas++;
          
                //echo "NO " . "\n";
              }
              else
              {
                //echo "SI " . "\n" ;
              } 
            }
            else
            {




                                $date_hoy = Carbon::now();
                                $date_hoy = $date_hoy->format('Y-m-d');
                                //echo "aqui llega--> " . $date;
                                $si_hoy_año=substr($date_hoy, 0, 4);
                                $si_hoy_mes=substr($date_hoy, 5, 2);
                                $si_hoy_dia=substr($date_hoy, 8);
                                $si_d_hoy=(int)$si_hoy_dia;
                                $si_m_hoy=(int)$si_hoy_mes;
                                $si_a_hoy=(int)$si_hoy_año;


                          

                              if(($si_a_hoy==$si_a_hoy)&&($si_m_hoy==$todoslosmesesdelaño[$k])&&($si_d_hoy==$todoslosdiasdelaño[$k]))
                              {




                      /***********************************************verifica continuo////////////////////////////////////////////*/
                      $d_continuos1=array();
                      $cuatrito=4;
                      $continuos1=Feriado::select('*')->where('id','=',$cuatrito)->get();
                      $diascontinuos1=$continuos1[0]['fechas'];
                      //echo ("total--> " . count($continuos1) . "\n");

                      if(strlen($diascontinuos1)<12)//2020-02-17
                      {
                        $d_continue1=$diascontinuos1;
                        array_push($d_continuos1, $d_continue1);
                      }
                      else
                      {
                        $d_continuos1=explode(",", $diascontinuos1);
                      }
                      
                      $banderita1=0;
                    
                      for ($i=0; $i <count($d_continuos1) ; $i++) 
                      { 
                        
                      $fecha_continua1=explode("-", $d_continuos1[$i]);
                
                        if(($si_a_hoy==$si_a_hoy)&&($fecha_continua1[1]==$todoslosmesesdelaño[$k])&&($fecha_continua1[2]==$todoslosdiasdelaño[$k]))
                        {
                          $banderita1=1;
                        }
                      }

                      if($banderita1==0)
                      {

                                    $inicio='12:29:59';
                                    $final='18:29:59';
                                    $i=Carbon::parse($inicio)->toTimeString();
                                    $f = Carbon::parse($final)->toTimeString();
                                    $nueve=Carbon::parse('09:00:00')->toTimeString();
                                    $doce=Carbon::parse('12:29:59')->toTimeString();
                                    if(($horita>=$nueve)&&($horita<=$doce))
                                    {

                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                          $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                          if($marco1=="[]")
                                          {
                                              //aqui penalizacion
                                              $cont_abandonos++;
                                          }
                                          else
                                          {
                                            $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                              if($atrasos1=="[]")
                                             {
                                                $cont_puntuales++;
                                             }
                                             else
                                             {
                                                  
                                                  $cont_atrasos++;

                                             }

                                          }
                                      }



                                      $cuatro=Carbon::parse('15:00:00')->toTimeString();
                                      $dieciseis=Carbon::parse('18:29:59')->toTimeString();
                                      if(($horita>=$cuatro)&&($horita<=$dieciseis))
                                      {

                                         //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                          $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                          if($marco1=="[]")
                                          {
                                              //aqui penalizacion
                                              $cont_abandonos++;
                                          }
                                          else
                                          {
                                            $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                              if($atrasos1=="[]")
                                             {
                                                $cont_puntuales++;
                                             }
                                             else
                                             {
                                                  
                                                  $cont_atrasos++;

                                             }

                                          }

                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 14:30
                                          $marco2=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->get();
                                          if($marco2=="[]")
                                          {
                                              $cont_abandonos++;
                                          }
                                          else
                                          {  
                                            

                                            $atrasos2=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->orderBy('hora', 'asc')->take(1)->get()->where('hora','>=','14:36:00');

                                            if($atrasos2=="[]")
                                             {

                                                $cont_puntuales++;
                                             }
                                             else
                                             {
                                                  
                                                  $cont_atrasos++;
                                           
                                             }

                                           }



                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 12:30
                                          $marco3=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->get();
                                          if($marco3=="[]")
                                          {
                                              $cont_abandonos++;
                                          }
                                          else
                                          {
                                             //del medio dia
                                             $atrasos3=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','12:30:00');
                                            if($atrasos3=="[]")
                                             {
                                              //  $cont_puntuales++;
                                             }
                                             else
                                             {
                                              $cont_abandonos++;
                                             }
                                          }

                                      }//fin if tarde

                      }//fin if sw==0 por verdad
                      else
                      {


                                    $inicio='12:29:59';
                                    $final='18:29:59';
                                    $i=Carbon::parse($inicio)->toTimeString();
                                    $f = Carbon::parse($final)->toTimeString();
                                    $nueve=Carbon::parse('09:00:00')->toTimeString();
                                    $doce=Carbon::parse('15:59:59')->toTimeString();
                                    if(($horita>=$nueve)&&($horita<=$doce))
                                    {

                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                          $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                          if($marco1=="[]")
                                          {
                                              //aqui penalizacion
                                              $cont_abandonos++;
                                          }
                                          else
                                          {
                                            $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:00:01');

                                              if($atrasos1=="[]")
                                             {
                                                $cont_puntuales++;
                                             }
                                             else
                                             {
                                                  
                                                  $cont_atrasos++;

                                             }
                   
                                          }
                                      }

                      }//fin else sw==0 por falso




                            }//cierre if verifica si es hoy por verdad
                            else
                            {




                                $d_continuos=array();
                                $cuatrito=4;
                                $continuos=Feriado::select('*')->where('id','=',$cuatrito)->get();
                                $diascontinuos=$continuos[0]['fechas'];
                                if(strlen($diascontinuos)<12)//2020-02-17
                                {
                                  $d_continue=$diascontinuos;
                                  array_push($d_continuos, $d_continue);
                                }
                                else
                                {
                                  $d_continuos=explode(",", $diascontinuos);
                                }
                                
                                $banderita=0;
                                for ($i=0; $i <count($d_continuos) ; $i++) 
                                { 

                                  $fecha_continua=explode("-", $d_continuos[$i]);

                                  if(($si_a_hoy==$si_a_hoy)&&($fecha_continua[1]==$todoslosmesesdelaño[$k])&&($fecha_continua[2]==$todoslosdiasdelaño[$k]))
                                  {
                                    $banderita=1;
                                    //echo ("entra:   " . $banderita);
                                  }
                                }

                                if($banderita==0)
                                {




                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                          $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                          if($marco1=="[]")
                                          {
                                              //aqui penalizacion
                                              $cont_abandonos++;
                                          }
                                          else
                                          {
                                            $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                              if($atrasos1=="[]")
                                             {
                                                $cont_puntuales++;
                                             }
                                             else
                                             {
                                                  
                                                  $cont_atrasos++;

                                             }

                                          }


                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 14:30
                                          $marco2=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->get();
                                          if($marco2=="[]")
                                          {
                                              $cont_abandonos++;
                                          }
                                          else
                                          {  
                                            

                                            $atrasos2=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->orderBy('hora', 'asc')->take(1)->get()->where('hora','>=','14:36:00');

                                            if($atrasos2=="[]")
                                             {

                                                $cont_puntuales++;
                                             }
                                             else
                                             {
                                                  
                                                  $cont_atrasos++;
                                           
                                             }

                                           }


                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 12:30
                                          $marco3=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->get();
                                          if($marco3=="[]")
                                          {
                                              $cont_abandonos++;
                                          }
                                          else
                                          {

                                             //del medio dia
                                             $atrasos3=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','12:30:00');
                                            if($atrasos3=="[]")
                                             {
                                              //  $cont_puntuales++;
                                             }
                                             else
                                             {
                                              $cont_abandonos++;
                                             }
                                          }







                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 18:30
                                          $marco4=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromd, $tod))->get();
                                          if($marco4=="[]")
                                          {
                                             $cont_abandonos++;
                                          }
                                          else
                                          {
                                             //de la noche
                                             $atrasos4=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromd, $tod))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','18:30:00');

                                            if($atrasos4=="[]")
                                             {

                                             }
                                             else
                                             {
                                                $cont_abandonos++;
                                                
                                             }
                                          }

                                  }//fin sw==0 por verdad
                                  else
                                  {


                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                          $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                          if($marco1=="[]")
                                          {
                                              //aqui penalizacion
                                              $cont_abandonos++;
                                          }
                                          else
                                          {
                                            $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:00:01');

                                              if($atrasos1=="[]")
                                             {
                                                $cont_puntuales++;
                                             }
                                             else
                                             {
                                                  
                                                  $cont_atrasos++;

                                             }
                                          
                                          }


                                            //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 16:00 horario continuo
                                          $marco4=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromde, $tode))->get();
                                          if($marco4=="[]")
                                          {
                                             $cont_abandonos++;
                                          }
                                          else
                                          {
                                             //de la noche
                                             $atrasos4=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromde, $tode))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','16:00:00');


                                            if($atrasos4=="[]")
                                             {

                                             }
                                             else
                                             {
                                                $cont_abandonos++;
                                                
                                             }
                                          }


                                  }//fin sw==0


                            
                            }//cierre if verifica si es hoy por falso


                  }//fin cierre el se si hay marcaciones
       
            
    }//fin if
    else
    {
    //    echo "<br>";

        $dos++;
        if($dos==2)
        {
            $contador=1;
            $dos=0;
        }
    }
  
}//fin for


$datositos=[$cont_puntuales,$cont_atrasos,$cont_permisos,$cont_faltas,$cont_abandonos];


        return ($datositos);
    }

    public function esferiado($dia_feriado,$mes_feriado,$feriado)
    {

      for($y=0;$y<count($feriado);$y=$y+1)
      {
       // echo "--> " . $feriado[$y] . " ";
      } 



    	$bandera=false;
            for($m=0;$m<(count($feriado));$m++) 
            { 
              if($m%2==0)
              {
                if(($dia_feriado==$feriado[$m])&&($mes_feriado==$feriado[$m+1]))
                {
                  $bandera=true;
                }
              }
            }
    	return $bandera;
    }

    public function diasexcepcionales(Request $request)
    {
      $detiene=$request->nombre;
      $array_nombre = explode(",",$detiene);
      //echo "--zzz " . $array_nombre[0];
      if($array_nombre[0]=='TODOS')
      {
        $usuariostodo=Usuario::all();
        
        for($h=0;$h<count($usuariostodo);$h++)
        {
          $horai=$request->hora;
          $cadi=$request->fecha;
          $array_fechai = explode(",",$cadi);
          $nuevo=new Asistencia();
          for($l=0;$l<count($array_fechai);$l++)
          {
            $nuevo->fecha=$array_fechai[$l];
            $nuevo->hora=$horai;
            $nuevo->ci=$usuariostodo[$h]['id'];
            $nuevo->save();
          }
        }
      }
      else
      {
          for($g=0;$g<count($array_nombre);$g++)
          {
            $cadenita_ci=explode(" ", $array_nombre[$g]);
            $longitud=count($cadenita_ci);
            $cad=$request->fecha;
            $array_fecha = explode(",",$cad);
            $hora=$request->hora;
            $agregado = new Asistencia();

            for($u=0;$u<count($array_fecha);$u++)
            {
              $agregado->fecha=$array_fecha[$u]; 
              $agregado->hora=$hora; 
              $agregado->ci=$cadenita_ci[$longitud-1];
              $agregado->save();
            }
          }
      }
    }
    public function reporteusuario(Request $request)
    {
      $carnet=$request->carnetid;//7066868;
      $de=$request->fechaini;//$de='2020-01-01';
      $hasta=$request->fechafin;//$hasta='2020-01-31';


      $recibe=$this->reporteusuarioso($carnet,$de,$hasta);

      $nombreusuario=Usuario::select('*')->where('id','=',$carnet)->get();


      $cuatrito=4;
      $continuos=Feriado::select('*')->where('id','=',$cuatrito)->get();
      $diascontinuo=$continuos[0]['fechas'];
      $diascontinuos=array();

      if(strlen($diascontinuo)<=12)
      {
        array_push($diascontinuos, $diascontinuo);
      }
      else
      {
        $diascontinuos=explode(",", $diascontinuo);
      }
      


      $usuariomes=Asistencia::select('*')->where('ci','=',$carnet)->whereBetween('fecha', array($de, $hasta))->orderBy('fecha', 'ASC')->orderBy('hora', 'ASC')->get();

      $usuarioatraso=Feriado::select('*')->where('id','=',21)->get();
      $arraysito = explode(",", $usuarioatraso[0]['fechas']);

      $usuarioatrasohora=Feriado::select('*')->where('id','=',21)->get();
      $arraysitohora = explode(",", $usuarioatrasohora[0]['horas']);


      $pdf = \PDF::loadView('vista-pdf-usuario', compact('nombreusuario','usuariomes','arraysito','arraysitohora','diascontinuos'))
      ->save(storage_path('app/public/') . 'informetodos.pdf');
      $url = storage_path('app/public/informetodos.pdf');
      $contents = file_get_contents($url);
      $string = base64_encode($contents);
      return response()->json($string);
    }






/************************ESTO ES UNA PRUEBA DE ANGULAR PARA PDF******************************************/
    public function reporteusuario2(Request $request)
    {
      $carnet=7066868;
      $de='2020-01-01';
      $hasta='2020-01-31';


      $recibe=$this->reporteusuarioso($carnet,$de,$hasta);

      $nombreusuario=Usuario::select('*')->where('id','=',$carnet)->get();


      $cuatrito=4;
      $continuos=Feriado::select('*')->where('id','=',$cuatrito)->get();
      $diascontinuo=$continuos[0]['fechas'];
      $diascontinuos=array();

      if(strlen($diascontinuo)<=12)
      {
        array_push($diascontinuos, $diascontinuo);
      }
      else
      {
        $diascontinuos=explode(",", $diascontinuo);
      }
      


      $usuariomes=Asistencia::select('*')->where('ci','=',$carnet)->whereBetween('fecha', array($de, $hasta))->orderBy('fecha', 'ASC')->orderBy('hora', 'ASC')->get();

      $usuarioatraso=Feriado::select('*')->where('id','=',21)->get();
      $arraysito = explode(",", $usuarioatraso[0]['fechas']);

      $usuarioatrasohora=Feriado::select('*')->where('id','=',21)->get();
      $arraysitohora = explode(",", $usuarioatrasohora[0]['horas']);


      $pdf = \PDF::loadView('vista-pdf-usuario', compact('nombreusuario','usuariomes','arraysito','arraysitohora','diascontinuos'))
      ->save(storage_path('app/public/') . 'informetodos.pdf');
      $url = storage_path('app/public/informetodos.pdf');
      $contents = file_get_contents($url);
      $string = base64_encode($contents);
      return response()->json($string);
    }

/************************FIN ESTO ES UNA PRUEBA DE ANGULAR PARA PDF******************************************/











































     public function reporteusuarioso($ci,$fechainicio,$fechafinal)
    {
        $feriado=array();
        $uno=1;
        $xxx=Feriado::select('*')->where('id','=',$uno)->get();
        $feriadoss=$xxx[0]['fechas'];
        $array = explode(",", $feriadoss);

      for($t=0;$t<count($array);$t=$t+1)
      {
           $mi_array= explode("-", $array[$t]);
           array_push($feriado,intval($mi_array[2]) ,intval($mi_array[1]));
      }
      /******************VERIFICAMOS SI TIENE PERMISOS*************************/
       $cis=$ci;
       $permi_feria=Usuario::where('id','=',$cis)->get();
       $permi=$permi_feria[0]['permisos'];
       //echo "savid " . $permi;
       if($permi!="")
       {

       if(strlen($permi)<=12) //2020-12-15
       {
          $usuario_permisos=$permi;
          $mi_array_permi= explode("-", $usuario_permisos);
          array_push($feriado,intval($mi_array_permi[2]) ,intval($mi_array_permi[1]));
       }
       else
       {
          $usuario_permisos= explode(",", $permi);
          for($o=0;$o<count($usuario_permisos);$o++)
          {
               $mi_array_permi= explode("-", $usuario_permisos[$o]);
               array_push($feriado,intval($mi_array_permi[2]) ,intval($mi_array_permi[1]));
               //echo "--> " . $feriado[$t] . "\n";
          }
       }
     }
/******************FIN VERIFICAMOS SI TIENE PERMISOS*************************/

/******************VERIFICAMOS SI TIENE VACACIONES*************************/
       $cis_1=$ci;
       $vaca_feria=Usuario::where('id','=',$cis_1)->get();
       $vaca=$vaca_feria[0]['vacaciones'];
       //echo "savid " . $permi;
       if($vaca!="")
       {

       if(strlen($vaca)<=12) //2020-12-15
       {
          $usuario_vacaciones=$vaca;
          $mi_array_vaca= explode("-", $usuario_vacaciones);
          array_push($feriado,intval($mi_array_vaca[2]) ,intval($mi_array_vaca[1]));
       }
       else
       {
          $usuario_vacaciones= explode(",", $vaca);
          for($q=0;$q<count($usuario_vacaciones);$q++)
          {
               $mi_array_vaca= explode("-", $usuario_vacaciones[$q]);
               array_push($feriado,intval($mi_array_vaca[2]) ,intval($mi_array_vaca[1]));
               //echo "--> " . $feriado[$t] . "\n";
          }
       }
     }
/******************FIN VERIFICAMOS SI TIENE VACACIONES*************************/
      

        $dia=1;
        $mes=1;
        $año=2024;
        $froma = date('06:30:00');
        $toa = date('10:30:00');
        $fromc = date('10:30:01');
        $toc = date('13:30:00');
        $fromb = date('13:30:01');
        $tob = date('16:00:00');
        $fromd = date('16:30:01');
        $tod = date('22:59:59');

        $fromde = date('16:30:01');
        $tode = date('22:59:59');

        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        //echo "aqui llega--> " . $date;
        $hoy_año=substr($date, 0, 4);
        $hoy_mes=substr($date, 5, 2);
        $hoy_dia=substr($date, 8);
        $d_hoy=(int)$hoy_dia;
        $m_hoy=(int)$hoy_mes;
        $a_hoy=(int)$hoy_año;
        $cont_atrasos=0;
        $cont_puntuales=0;
        $cont_faltas=0;
        $cont_abandonos=0;
        $cont_permisos=0;

      
      $fechainicioreporte=$fechainicio;
      $fechafinreporte=$fechafinal;
    
       
       $fechainic=explode('"', $fechainicioreporte);
       $fechainic=explode('-', $fechainic[0]);
       $fechainicioreporte_año=$fechainic[0];
       $fechainicioreporte_mes=$fechainic[1];
       $fechainicioreporte_dia=$fechainic[2];

       $fechafin=explode('"', $fechafinreporte);
       $fechafin=explode('-', $fechafin[0]);
       $fechafinaleporte_año=$fechafin[0];
       $fechafinaleporte_mes=$fechafin[1];
       $fechafinaleporte_dia=$fechafin[2];



        $d_hoy=$fechafinaleporte_dia;
        $m_hoy=$fechafinaleporte_mes;


        $cedula=$ci;
        $fechaspermisos=Usuario::select('permisos')->where('id','=',$cedula)->get();
        $solano=explode(",", $fechaspermisos[0]['permisos']);
$json_de_permisos=[];
$mi_array_permisos=[];
        

        
        for($b=0;$b<count($solano);$b++)
        {

if(((date("Y-m-d H:i:s",strtotime($solano[$b])))>=(date("Y-m-d H:i:s",strtotime($fechainicioreporte_año . "-" . $fechainicioreporte_mes . "-" .$fechainicioreporte_dia))))&&((date("Y-m-d H:i:s",strtotime($solano[$b])))<=(date("Y-m-d H:i:s",strtotime($fechafinaleporte_año . "-" . $fechafinaleporte_mes . "-" .$fechafinaleporte_dia)))))
          {
              $mi_array_permisos=array('fecha'=>$solano[$b],'observacion'=>'..::SIN DESCRIPCIÓN::..','cantidad'=>1);
              array_push($json_de_permisos, $mi_array_permisos);
              $cont_permisos++;
          }
          
           
        }


/**INICIO GUARDA DATOS DE LOS MESES DE ENERO(1-31), FEBRERO(1-30) Y ASI HASTA DICIEMBRE EN LA VARIABLE x[]**/  
//------------testeado funcionando ---------------------------
$cont=1;
$contadordemes=1;
$bisiesto=0;
if($a_hoy%4==0)
{
  $bisiesto=1;
}
$todoslosdiasdelaño[0]=0;
$todoslosmesesdelaño[0]=0;
for($i=1;$i<=365+$bisiesto;$i++)
{
     $todoslosdiasdelaño[$i]=$cont;
     $todoslosmesesdelaño[$i]=$contadordemes;
    $cont++; 
    if(($i==31)||($i==59+$bisiesto)||($i==90+$bisiesto)||($i==120+$bisiesto)||($i==151+$bisiesto)||($i==181+$bisiesto)||($i==212+$bisiesto)||($i==243+$bisiesto)||($i==273+$bisiesto)||($i==304+$bisiesto)||($i==334+$bisiesto)||($i==365+$bisiesto))
    {
        $cont=1;
        $contadordemes++;
    }
   
}
/**FIN GUARDA DATOS DE LOS MESES DE ENERO(1-31), FEBRERO(1-30) Y ASI HASTA DICIEMBRE EN LA VARIABLE x[]**/  

//**********FECHA INGRESO A LA INSTITUCION*******//
$dia_ingreso=intval($fechainicioreporte_dia);
$mes_ingreso=intval($fechainicioreporte_mes);
$mesa=1;//inicia el contador de mes
//*******FIN FECHA INGRESO A LA INSTITUCION*******//

//************************************INICIO SEPARA 5 DIAS DE LA SEMANA Y DOS FINES DE SEMANA*********************************************//
if($a_hoy==2018)
{
  $contador=1;
}
if($a_hoy==2019)
{
  $contador=2;
}
if($a_hoy==2020)
{
  $contador=3;
}

$dos=0;
for ($i=1; $i <= 365; $i++) 
{
    if($contador<=5)
    {
      $contador_de_dias_semana=$contador;
      $contador++;  
    }
    else
    {
        $dos++;
        if($dos==2)
        {
            $contador=1;
            $dos=0;
        }
    }
  if(($todoslosdiasdelaño[$i]==$dia_ingreso)&&($mesa==$mes_ingreso))
  {
    $posicion_dia_ingreso=$i;
    $posicion_mes_ingreso=$todoslosmesesdelaño[$i];
    $copia=$mesa;
    break;
  }
  if(($i==(31))||($i==(59+$bisiesto))||($i==(90+$bisiesto))||($i==(120+$bisiesto))||($i==(151+$bisiesto))||($i==(181+$bisiesto))||($i==(212+$bisiesto))||($i==(243+$bisiesto))||($i==(273+$bisiesto))||($i==(304+$bisiesto))||($i==(334+$bisiesto))||($i==(365+$bisiesto)))
    {
      $mesa=$mesa+1 ;
    }
}



//********************************************FIN SEPARA 5 DIAS DE LA SEMANA Y DOS FINES DE SEMANA*********************************************//

//*************************PARA OBTENER INDICES***********************//
for($t=1;$t<=count($todoslosdiasdelaño);$t++)
{
  //echo "SIIII " . $d_hoy . " = " . $todoslosdiasdelaño[$t] . " Y " . $m_hoy . " = " . $todoslosmesesdelaño[$t] ."\n";//print principal de este modulo
  if(($d_hoy==$todoslosdiasdelaño[$t])&&($m_hoy==$todoslosmesesdelaño[$t]))
  {
    $posicion_d_hoy=$t;
    $posicion_m_hoy=$t;
    break;
  }
}

//**********************FIN PARA OBTENER INDICES**********************//
$SUMA_SEGUNDOS_1=0;
$SUMA_SEGUNDOS_2=0;
$penalizacionpornomarcar=0;
$sumadesegundostotales=0;
$sumademinutostotales=0;
$sumadehorastotales=0;
$contador_de_faltas=0;
$contador=$contador_de_dias_semana;
$mi_array_atrasos=[];
$mi_array_faltas=[];
$mi_array_abandonos=[];
$dias_haberes_faltas=0;
$cont_haberes_faltas=0;
$json_de_atrasos=[];
$json_de_faltas=[];
$json_de_abandonos=[];
$destitucion='';
$datehoy =Carbon::now('America/La_Paz');
$horita=$datehoy->format('H:i:s');

for($k=$posicion_dia_ingreso;($k<=$posicion_d_hoy)&&($posicion_mes_ingreso<=$todoslosmesesdelaño[$posicion_m_hoy]);$k++)
{
  $copia_minutos=0;
  $copia_abandonos=0;
  if($contador<=5)
    {
          $contador++;
            $fecha=$a_hoy . "-" . $todoslosmesesdelaño[$k] . "-" . $todoslosdiasdelaño[$k]. "";
          //  echo "" . $fecha . "\n";//print fecha principal de este modulo

            //$faltas1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->get();
            $haymarcasiones=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->get();


            if($haymarcasiones=="[]")
            {
              //aqui no hay marcasiones
              /***********VERIFICANDO SI ES DIA FERIADO************/
              if(!($this->esferiado($todoslosdiasdelaño[$k],$todoslosmesesdelaño[$k],$feriado)))
              {
                $cont_faltas++;
                $cont_haberes_faltas++;
                if($cont_haberes_faltas==1)
                {
                  $dias_haberes_faltas=0.5;
                  $contador_de_faltas=$contador_de_faltas+$dias_haberes_faltas;
                }
                else
                {
                  if($cont_haberes_faltas==2)
                  {
                    $dias_haberes_faltas=1;
                    $contador_de_faltas=$contador_de_faltas+$dias_haberes_faltas;
                  }
                  else
                  {
                    if($cont_haberes_faltas>=3)
                    {
                      $dias_haberes_faltas=2;
                      $contador_de_faltas=$contador_de_faltas+$dias_haberes_faltas;
                      $destitucion=' Destitución';
                    }
                  }
                }

                $mi_array_faltas = array('fecha' => $fecha , 'sancion' => $dias_haberes_faltas . ' ' );
                array_push($json_de_faltas, $mi_array_faltas);  
              }
              else
              {
              } 
            }
            else
            {

              $date_hoy = Carbon::now();
              $date_hoy = $date_hoy->format('Y-m-d');
              $si_hoy_año=substr($date_hoy, 0, 4);
              $si_hoy_mes=substr($date_hoy, 5, 2);
              $si_hoy_dia=substr($date_hoy, 8);
              $si_d_hoy=(int)$si_hoy_dia;
              $si_m_hoy=(int)$si_hoy_mes;
              $si_a_hoy=(int)$si_hoy_año;



            if(($si_a_hoy==$si_a_hoy)&&($si_m_hoy==$todoslosmesesdelaño[$k])&&($si_d_hoy==$todoslosdiasdelaño[$k]))
            {

              $inicio='12:29:59';
              $final='18:29:59';
              $i=Carbon::parse($inicio)->toTimeString();
              $f = Carbon::parse($final)->toTimeString();

              $nueve=Carbon::parse('09:00:00')->toTimeString();
              $doce=Carbon::parse('12:29:59')->toTimeString();
              if(($horita>=$nueve)&&($horita<=$doce))
              {
                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                  $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                  if($marco1=="[]")
                                                  {
                                                      //aqui penalizacion
                                                          $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
                                                   
                                                  }
                                                  else
                                                  {
                                                    $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                                      //echo("ATRASOS A--> " . $atrasos1 . "\n");
                                                      if($atrasos1=="[]")
                                                     {
                                                        $cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                          $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                          $HORA_1=$VALORHORA_1[0];
                                                          $MINUTOS_1=$VALORHORA_1[1];
                                                          $SEGUNDOS_1=$VALORHORA_1[2];
                                                          if($HORA_1==8)
                                                          {
                                                            $sumademinutostotales=$sumademinutostotales+($MINUTOS_1-30);
                                                            $copia_minutos=$MINUTOS_1-30;
                                                        
                                                          }
                                                          else
                                                          {
                                                            if($HORA_1==9)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                              $copia_minutos=30+$MINUTOS_1;

                                                            }
                                                            if($HORA_1==10)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                              $copia_minutos=90+$MINUTOS_1;
                                                            }
                                                          }
                                                          $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                          $cont_atrasos++;
                                                         $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                         array_push($json_de_atrasos, $mi_array_atrasos);  

                                                     }
   
                                                  }
              }
              $cuatro=Carbon::parse('15:00:00')->toTimeString();
              $dieciseis=Carbon::parse('18:29:59')->toTimeString();
              if(($horita>=$cuatro)&&($horita<=$dieciseis))
              {
                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 14:30
                                                  $marco2=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->get();
                                                  if($marco2=="[]")
                                                  {
                                                      //aqui penalizacion
                                                          $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (tarde)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
                                                  }
                                                  else
                                                  {  
                                                    

                                                    $atrasos2=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->orderBy('hora', 'asc')->take(1)->get()->where('hora','>=','14:36:00');
                                                    //echo("ATRASOS B--> " . $atrasos2 . "\n");

                                                    if($atrasos2=="[]")
                                                     {

                                                        $cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                          $VALORHORA_2=explode(':', $atrasos2[0]["hora"]);
                                                          $HORA_2=$VALORHORA_2[0];
                                                          $MINUTOS_2=$VALORHORA_2[1];
                                                          $SEGUNDOS_2=$VALORHORA_2[2];
                                                          if($HORA_2==14)
                                                          {
                                                            $sumademinutostotales=$sumademinutostotales+($MINUTOS_2-30);
                                                            $copia_minutos=$MINUTOS_2-30;
                                                          }
                                                          else
                                                          {
                                                            if($HORA_2==15)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_2;
                                                              $copia_minutos=30+$MINUTOS_2;
                                                            }
                                                            if($HORA_2==16)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_2;
                                                              $copia_minutos=90+$MINUTOS_2;
                                                            }
                                                          }
                                                          $SUMA_SEGUNDOS_2=$SUMA_SEGUNDOS_2+$SEGUNDOS_2;
                                                          $cont_atrasos++;
                                                          $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos2[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_2 );
                                                         array_push($json_de_atrasos, $mi_array_atrasos);
                                                     }
                                                   }








                                                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 12:30
                                                  $marco3=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->get();
                                                  if($marco3=="[]")
                                                  {
                                                      //aqui penalizacion
                                                    $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
                                                  }
                                                  else
                                                  {

                                                     //del medio dia
                                                     $atrasos3=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','12:30:00');

                                                     //echo("ATRASOS C--> " . $atrasos3 . "\n");
                                                    if($atrasos3=="[]")
                                                     {
                                                      //  $cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                      $cont_abandonos++;
                                                      $copia_abandonos=1;
                                                      $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)", 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN DATOS:..', 'abandona'=> $copia_abandonos );
                                                         array_push($json_de_abandonos, $mi_array_abandonos);

                                                        
                                                  
                                                     }
                                                   
                                                  }





              }


            }
            else
            {

                                $d_continuos=array();
                                $cuatrito=4;
                                $continuos=Feriado::select('*')->where('id','=',$cuatrito)->get();
                                $diascontinuos=$continuos[0]['fechas'];
                                if(strlen($diascontinuos)<12)//2020-02-17
                                {
                                  $d_continue=$diascontinuos;
                                  array_push($d_continuos, $d_continue);
                                }
                                else
                                {
                                  $d_continuos=explode(",", $diascontinuos);
                                }
                                
                                $banderita=0;
                                for ($i=0; $i <count($d_continuos) ; $i++) 
                                { 

                                  $fecha_continua=explode("-", $d_continuos[$i]);

                                  if(($si_a_hoy==$si_a_hoy)&&($fecha_continua[1]==$todoslosmesesdelaño[$k])&&($fecha_continua[2]==$todoslosdiasdelaño[$k]))
                                  {
                                    $banderita=1;
                                  }
                                }

                                if($banderita==0)
                                {






                                                  //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                  $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                  if($marco1=="[]")
                                                  {
                                                      //aqui penalizacion
                                                          $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
    
                                                  }
                                                  else
                                                  {
                                                    $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:36:00');

                                                      if($atrasos1=="[]")
                                                     {
                                                        $cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                          $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                          $HORA_1=$VALORHORA_1[0];
                                                          $MINUTOS_1=$VALORHORA_1[1];
                                                          $SEGUNDOS_1=$VALORHORA_1[2];
                                                          if($HORA_1==8)
                                                          {
                                                            $sumademinutostotales=$sumademinutostotales+($MINUTOS_1-30);
                                                            $copia_minutos=$MINUTOS_1-30;
   
                                                          }
                                                          else
                                                          {
                                                            if($HORA_1==9)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                              $copia_minutos=30+$MINUTOS_1;
   
                                                            }
                                                            if($HORA_1==10)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                              $copia_minutos=90+$MINUTOS_1;
     
                                                            }
                                                          }
                                                          $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                        //echo "                 suma segundos A " . $SUMA_SEGUNDOS_1 . "\n";
                                                          $cont_atrasos++;
                                                         $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                         array_push($json_de_atrasos, $mi_array_atrasos);  

                                                     }
          
                                                  }









                                                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 14:30
                                                  $marco2=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->get();
                                                  if($marco2=="[]")
                                                  {
                                                      //aqui penalizacion
                                                          $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (tarde)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
                                                  }
                                                  else
                                                  {  
                                                    

                                                    $atrasos2=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromb, $tob))->orderBy('hora', 'asc')->take(1)->get()->where('hora','>=','14:36:00');
                                                    //echo("ATRASOS B--> " . $atrasos2 . "\n");

                                                    if($atrasos2=="[]")
                                                     {

                                                        $cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                          $VALORHORA_2=explode(':', $atrasos2[0]["hora"]);
                                                          $HORA_2=$VALORHORA_2[0];
                                                          $MINUTOS_2=$VALORHORA_2[1];
                                                          $SEGUNDOS_2=$VALORHORA_2[2];
                                                          if($HORA_2==14)
                                                          {
                                                            $sumademinutostotales=$sumademinutostotales+($MINUTOS_2-30);
                                                            $copia_minutos=$MINUTOS_2-30;
                                                          }
                                                          else
                                                          {
                                                            if($HORA_2==15)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_2;
                                                              $copia_minutos=30+$MINUTOS_2;
                                                         
                                                            }
                                                            if($HORA_2==16)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_2;
                                                              $copia_minutos=90+$MINUTOS_2;
                                                          
                                                            }
                                                          }
                                                          $SUMA_SEGUNDOS_2=$SUMA_SEGUNDOS_2+$SEGUNDOS_2;
                                                          $cont_atrasos++;
                                                          $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos2[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_2 );
                                                         array_push($json_de_atrasos, $mi_array_atrasos);
                                                     }
                                                  
                                                   }








                                                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 12:30
                                                  $marco3=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->get();
                                                  if($marco3=="[]")
                                                  {
                                                      //aqui penalizacion
                                                    $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
                                                  }
                                                  else
                                                  {

                                                     //del medio dia
                                                     $atrasos3=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromc, $toc))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','12:30:00');

                                                    if($atrasos3=="[]")
                                                     {
                                                      //  $cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                      $cont_abandonos++;
                                                      $copia_abandonos=1;
                                                      $mi_array_abandonos = array('fecha' => $fecha . " (mediodia)", 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN DATOS:..', 'abandona'=> $copia_abandonos );
                                                         array_push($json_de_abandonos, $mi_array_abandonos);

                                      
                                                     }
                                                    
                                                  }






                                                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 18:30
                                                  $marco4=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromd, $tod))->get();
                                                  if($marco4=="[]")
                                                  {
                                                      //aqui penalizacion
                                                          $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (noche)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..','abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
                                                  }
                                                  else
                                                  {
                                                     //de la noche
                                                     $atrasos4=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromd, $tod))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','18:30:00');

                                                    if($atrasos4=="[]")
                                                     {
                                                        //$cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                        $cont_abandonos++;
                                                        $copia_abandonos=1;
                                                        $mi_array_abandonos = array('fecha' => $fecha . " (noche)" , 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN   DATOS:..', 'abandona'=> $copia_abandonos);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);  
                                                     }
                                                   
                                                  }

                                      }//fin sw==0 por verdad
                                      else
                                      {
                                                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 8:30
                                                  $marco1=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->get();
                                                  if($marco1=="[]")
                                                  {
                                                      //aqui penalizacion
                                                          $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (mañana)" , 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..' ,'abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
    
                                                  }
                                                  else
                                                  {
                                                    $atrasos1=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($froma, $toa))->orderBy('hora', 'asc')->get()->take(1)->where('hora','>=','08:00:01');

                                                      if($atrasos1=="[]")
                                                     {
                                                        $cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                          $VALORHORA_1=explode(':', $atrasos1[0]["hora"]);
                                                          $HORA_1=$VALORHORA_1[0];
                                                          $MINUTOS_1=$VALORHORA_1[1];
                                                          $SEGUNDOS_1=$VALORHORA_1[2];
                                                          if($HORA_1==8)
                                                          {
                                                            $sumademinutostotales=$sumademinutostotales+($MINUTOS_1-30);
                                                            $copia_minutos=$MINUTOS_1-30;
   
                                                          }
                                                          else
                                                          {
                                                            if($HORA_1==9)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+30+$MINUTOS_1;
                                                              $copia_minutos=30+$MINUTOS_1;
   
                                                            }
                                                            if($HORA_1==10)
                                                            {
                                                              $sumademinutostotales=$sumademinutostotales+90+$MINUTOS_1;
                                                              $copia_minutos=90+$MINUTOS_1;
     
                                                            }
                                                          }
                                                          $SUMA_SEGUNDOS_1=$SUMA_SEGUNDOS_1+$SEGUNDOS_1;
                                                        //echo "                 suma segundos A " . $SUMA_SEGUNDOS_1 . "\n";
                                                          $cont_atrasos++;
                                                         $mi_array_atrasos = array('fecha' => $fecha , 'hora'=> $atrasos1[0]['hora'] , 'mins' => $copia_minutos , 'segs' => $SEGUNDOS_1 );
                                                         array_push($json_de_atrasos, $mi_array_atrasos);  
                                                       }
          
                                                  }




                                                    //AQUI SI MARCO, SIN EMBARGO COMPROBAMOS SI MARCO EL LA HORA ESTABLECIDA 16:00 horario continuo
                                                  $marco4=Asistencia::select('*')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromde, $tode))->get();
                                                  if($marco4=="[]")
                                                  {
                                                      //aqui penalizacion
                                                          $cont_abandonos++;
                                                          $penalizacionpornomarcar=$penalizacionpornomarcar+30;
                                                          $mi_array_abandonos = array('fecha' => $fecha . " (noche)", 'hora'=> '..:NO MARCO:..' , 'mins' => '..:SIN DATOS:..' , 'segs' => '..:SIN DATOS:..','abandona'=> 1);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);
                                                  }
                                                  else
                                                  {
                                                     //de la noche
                                                     $atrasos4=Asistencia::select('id','fecha','hora','ci')->where('ci','=',$cis)->where('fecha','=',$fecha)->whereBetween('hora', array($fromde, $tode))->orderBy('hora', 'desc')->take(1)->get()->where('hora','<','16:00:00');

                                                    if($atrasos4=="[]")
                                                     {
                                                        //$cont_puntuales++;
                                                     }
                                                     else
                                                     {
                                                        $cont_abandonos++;
                                                        $copia_abandonos=1;
                                                        $mi_array_abandonos = array('fecha' => $fecha . " (noche)" , 'hora'=> '..::NO MARCO::..' , 'mins' => '..::SIN DATOS:..' , 'segs' => '..::SIN   DATOS:..', 'abandona'=> $copia_abandonos);
                                                         array_push($json_de_abandonos, $mi_array_abandonos);

                                                         
                                                     }
                                                   
                                                  }


                                      }//fin sw==0 por falso

                      }//fin if verifica si es hoy

        }//fin else si hay marcaciones
            
    }
    else
    {

        $dos++;
        if($dos==2)
        {
            $contador=1;
            $dos=0;
        }
    }
  
}

  $divsegundos_entero=intdiv(($SUMA_SEGUNDOS_1 + $SUMA_SEGUNDOS_2),60 );
  $divsegundos_modulo=($SUMA_SEGUNDOS_1 + $SUMA_SEGUNDOS_2)%60;
  $data = [$json_de_atrasos,$json_de_faltas, $json_de_abandonos,$json_de_permisos];



  $numero_1='21';
  $estructura_1=Feriado::where('id','=',$numero_1)->first();  

  $estructura_1->descripcion="ATRASOS";
  $nose='';
  for($tt=0;$tt<count($json_de_atrasos);$tt++)
  {
    if(($tt+1)==count($json_de_atrasos))
    {
      $nose=$nose . date('Y-m-d', strtotime($json_de_atrasos[$tt]['fecha']));
    }
    else
    {
      $nose=$nose . date('Y-m-d', strtotime($json_de_atrasos[$tt]['fecha'])) . ",";
    }
    
  }
  $nose_1='';
  for($tt=0;$tt<count($json_de_atrasos);$tt++)
  {
    if($tt+1==count($json_de_atrasos))
    {
      $nose_1=$nose_1 . $json_de_atrasos[$tt]['hora'];
    }
    else
    {
      $nose_1=$nose_1 . $json_de_atrasos[$tt]['hora'] . ",";
    }  
  }

  $estructura_1->fechas=$nose;
  $estructura_1->horas=$nose_1;
  $estructura_1->save();


  $numero_2='22';
  $estructura_2=Feriado::where('id','=',$numero_2)->first(); 
  //$estructura_2=new Feriado();
  //$estructura_2->id='22';
  $estructura_2->descripcion="FALTAS";
  $nose_2='';
  for($tt=0;$tt<count($json_de_faltas);$tt++)
  {
    if(($tt+1)==count($json_de_faltas))
    {
      $nose_2=$nose_2 . $json_de_faltas[$tt]['fecha'];
    }
    else
    {
      $nose_2=$nose_2 . $json_de_faltas[$tt]['fecha'] . ",";
    }
  }
  
  $estructura_2->fechas=$nose_2;
  $estructura_2->horas='';
  $estructura_2->save();



  $numero_3='23';
  $estructura_3=Feriado::where('id','=',$numero_3)->first(); 
  //$estructura_3=new Feriado();
  //$estructura_3->id='23';
  $estructura_3->descripcion="PERMISOS";
  $nose_3='';
  for($tt=0;$tt<count($json_de_permisos);$tt++)
  {
    if(($tt+1)==count($json_de_permisos))
    {
      $nose_3=$nose_3 . $json_de_permisos[$tt]['fecha'];
    }
    else
    {
      $nose_3=$nose_3 . $json_de_permisos[$tt]['fecha'] . ",";
    }
  }
  
  $estructura_3->fechas=$nose_3;
  $estructura_3->horas='';
  $estructura_3->save();



  $numero_4='24';
  $estructura_4=Feriado::where('id','=',$numero_4)->first(); 
  $estructura_4->descripcion="ABANDONOS";
  $nose_44='';
  for($tt=0;$tt<count($json_de_abandonos);$tt++)
  {
    if(($tt+1)==count($json_de_abandonos))
    {
      $nose_44=$nose_44 . $json_de_abandonos[$tt]['fecha'];
    }
    else
    {
      $nose_44=$nose_44 . $json_de_abandonos[$tt]['fecha'] . ",";
    }
    
  }


  $estructura_4->fechas=$nose_44;
  $estructura_4->horas='';
  $estructura_4->save();

    }
}
