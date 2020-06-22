<?php
namespace App\Http\Controllers;
use App\Asistencia;
use App\Salida;
use App\Usuario;
use App\Notificacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsisController extends Controller
{


  public function desarmaname(Request $request)
  {
      $names=$request->fullname;
      $des = explode(' ',$names);
      $name = $des[0];
      $father = $des[1];
      $mother = $des[2];
      $completo=Usuario::select('*')->where('nombre','=',$name)->where('paterno','=',$father)->where('materno','=',$mother)->get();
      if($completo=="[]")
      {
        $name = $des[0];
        $lastname = $des[1];
        $name=$name . " " .$lastname;
        $father = $des[2];
        $mother = $des[3];
        $completo=Usuario::select('*')->where('nombre','=',$name)->where('paterno','=',$father)->where('materno','=',$mother)->get();
        if($completo=="[]")
        {
          $name = $des[0];
          $lastname = $des[1];
          $postname = $des[2];
          $name=$name . " " .$lastname . " " .$postname;
          $father = $des[3];
          $mother = $des[4];
          $completo=Usuario::select('*')->where('nombre','=',$name)->where('paterno','=',$father)->where('materno','=',$mother)->get();
            if($completo=="[]")
            {
              $name = $des[0];
              $lastname = $des[1];
              $name=$name . " " .$lastname;
              $father = $des[2];
              $lastfather = $des[3];
              $father=$father . " " . $lastfather;
              $mother = $des[4];
              $completo=Usuario::select('*')->where('nombre','=',$name)->where('paterno','=',$father)->where('materno','=',$mother)->get();
              
            }
            if($completo=="[]")
            {
              $name = $des[0];
              $father = $des[1];
              $lastfather = $des[2];
              $father=$father . " " . $lastfather;
              $mother = $des[3];
              $completo=Usuario::select('*')->where('nombre','=',$name)->where('paterno','=',$father)->where('materno','=',$mother)->get();        
            }

        }
      }
      return response()->json(array('CARNET'=>$completo[0]{"id"},'cliente'=>$completo));
    }

  public function iniciarrayferiado(Request $request)
  {
    $this->myvar = 'foo';

    echo ("count-> " . count($this->feriado));
       $list=$request->all();
        $filtro = json_decode($list['data']);
       foreach($filtro as $obj)
        {
          $feria_dia=$obj->dia;
          $feria_mes=$obj->mes;
          //echo (" " . $xxx);
          $this->feriado[] = (int) $feria_dia;
          $this->feriado[] = (int) $feria_mes;
        }
                         echo ("count final " . count($this->feriado) . "******");

        for($i=0;$i<count($this->feriado);$i++)
        {
            echo (" ".$this->feriado[$i]);
        }
  }

    public function obtienepasantes(Request $request)
  {
        $pasantes=Usuario::select('*')->where('estado','like','activo')->where('cargo','like','%PASANTE%')->get();
        return response()->json($pasantes);
  }

 public function retpapeletas(Request $request)
  {

    $pasantes=Salida::all();
      $pdf = \PDF::loadView('vista-pdf-prueba', compact('pasantes'))
    ->save(storage_path('app/public/') . 'informe.pdf');
    $url = storage_path('app/public/informe.pdf');
      $contents = file_get_contents($url);
      $string = base64_encode($contents);

        return response()->json($string);


  }

  public function consultareport(Request $request)
  {
      $usuariorrhh=$request->usuario;
      $contraseñarrhh=$request->contraseña;

      $jeferrhh=Usuario::select('*')->where('usuario','=',$usuariorrhh)->where('contraseña','=',$contraseñarrhh)->get();
      $getjefaso=Usuario::select('*')->where('cargo','=','DIRECTOR GENERAL EJECUTIVO')->get();
      return response()->json(array('RRHH' => $jeferrhh,'JEFASO' => $getjefaso,'gg' => $this->feriado[21] ));
  }

    public function consulta(Request $request)
    {
        $zzz=Usuario::all();
        return response()->json($zzz);
    }

    public function consultausuarios(Request $request)
    {
        $zzz=Usuario::select('*')->where('cargo','NOT LIKE','%DIRECTOR%')->where('estado','like','activo')->get();
        return response()->json($zzz);
    }

    public function consultausuariosbaja(Request $request)
    {
        $inactivos=Usuario::select('*')->where('estado','like','inactivo')->get();
        return response()->json($inactivos);
    }

    public function consultausupordep(Request $request)
    {
        $departamento=$request->departament;
        $zzz=Usuario::select('*')->where('cargo','NOT LIKE','%DIRECTOR%')->where('estado','like','activo')->where('departamento','=',$departamento)->get();
        return response()->json($zzz);
    }

    public function nombreunido(Request $request)
    {
        $unido=Usuario::select('CONCAT(`nombre`," ",`paterno`)')->get();
        return response()->json($unido);
    }

     public function consdire(Request $request)
    {
        $direccion=$request->dire;
        $usuariospordireccion=Usuario::select('*')->where('cargo','NOT LIKE','%DIRECTOR%')->where('departamento','=',$direccion)->get();
        return response()->json($usuariospordireccion);
    }

    public function adicionausu(Request $request)
    {
        $usuario=new Usuario;
        $usuario->id=$request->carnet;
        $usuario->paterno=$request->paterno;
        $usuario->materno=$request->materno;
        $usuario->nombre=$request->nombre;
        $usuario->usuario=$request->usuario;
        $usuario->contraseña=$request->contraseña;
        $usuario->cargo=$request->cargo;
        $usuario->departamento=$request->departamento;
        $usuario->estado="activo";
        $usuario->fechaingreso=$request->fechaingres;
        $usuario->foto="usuario.png";
        $usuario->permisos="";
        $usuario->licencias="";
        $usuario->vacaciones="";
        
        $usuario->save();
    }

      public function actualizausu(Request $request)
    {
        $carnet_id=$request->ci_actual;
        $usuario=Usuario::where('id','=',$carnet_id)->first();
        $usuario->id=$request->carnet;
        $usuario->paterno=$request->paterno;
        $usuario->materno=$request->materno;
        $usuario->nombre=$request->nombre;
        $usuario->usuario=$request->usuario;
        $usuario->contraseña=$request->contraseña;
        $usuario->cargo=$request->cargo;
        $usuario->departamento=$request->departamento;
        $usuario->estado="activo";
        $usuario->fechaingreso=$request->fechaingres;
        $usuario->save();
    }

    public function eliminausu(Request $request)
    {
        $carnet_identidad=$request->carnet;
        $elimina=Usuario::find($carnet_identidad);
        $elimina->estado="inactivo";
        $elimina->save();
        return response()->json($elimina);
    }

    public function consultapost(Request $request)
    {
        $cis=$request->codigousu;
        $fechas=$request->fecha;
        //$zzz=Asistencia::all();
        $datos=Asistencia::select('ci','fecha','hora')->where('ci','=',$cis)->where('fecha','=',$fechas)->get();
        return response()->json($datos);
    } 

     public function consultacalendar(Request $request)
    {
        $cis=$request->codigousu;
        $datos=Asistencia::select('ci','fecha','hora')->where('ci','=',$cis)->get();
        return response()->json($datos);
    }

    public function consultafechas(Request $request)
    {
        $cis=$request->codigousu;
        $fechas=$request->fecha;

        $año=substr($fechas, 0, 4);
        $mes=substr($fechas, 5, 2);
        $dia=substr($fechas, 8);



        $d=(int)$dia;
        //$d=$d-1;
        $m=(int)$mes;
        $a=(int)$año;


        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $hoy_año=substr($date, 0, 4);
        $hoy_mes=substr($date, 5, 2);
        $hoy_dia=substr($date, 8);
        $dia_hoy=(int)$hoy_dia;
        $mes_hoy=(int)$hoy_mes;
        $año_hoy=(int)$hoy_año;


        $sw=0;
        if($d>$dia_hoy)
        {
           $salida=[];
           return response()->json($salida);
        }
        else
        {
        while(($d<=$dia_hoy)&&($sw==0))
        {
          $cad_mes="";
                $cad_dia="";

          if($m<10)
          {
            $cad_mes="0" . $m;
          }
          else
          {
            $cad_mes=$m;
          }
          
          if($d<10)
          {
            $cad_dia="0" . $d;
          }
          else
          {
            $cad_dia=$d;
          }
              $fech=$a . "-" . $cad_mes . "-" . $cad_dia;


          $asiste=Asistencia::select('*')->where('ci','like',$cis)->where('fecha','like',$fech)->get();
          if($asiste=="[]")
          {
            $d=$d+1;
          }
          else
          {
            $sw=1;
          }
        }
        return response()->json($asiste);
      }
    } 

    public function consultadavid(Request $request)
    {
        $lista=$request->all();
        $res;
        $filters = json_decode($lista['data']);
        foreach($filters as $obj)
        {
           $asistencia=new Asistencia;
           $asistencia->ci = $obj->ci;
           $asistencia->fecha = $obj->fecha;
           $asistencia->hora = $obj->hora;
           $res[]=$asistencia;

            $usuarrio=Usuario::select('*')->where('id','=',$obj->ci)->get();           
           
           if($usuarrio=="[]")
           {

           }
           else
           {
               $duplicado=Asistencia::select('*')->where('ci','=',$obj->ci)->where('fecha','=',$obj->fecha)->where('hora','=',$obj->hora)->get();

               if($duplicado=="[]")
               {
                   $asistencia->save();
               }
               else
               {
                    echo "la asistencia ya existe";
               }
         }
        }
        return response()->json($asistencia);    
    }


    public function vistapreviapapeleta(Request $request)
    {
           $salida=new Salida;
           $salida->cod_nombre = $request->nombre;
           $salida->motivo = $request->motivo;
           $salida->lugar = $request->lugar;
           $salida->fecha = $request->date;
           $salida->horasalida = $request->picker;
           $salida->horaretorno = $request->picker1;

           if(($request->picker=='00:00:00')&&($request->picker1=='00:00:00'))
           {
              $salida->horasalida=null;
              $salida->horaretorno=null;
           }
           if ($request->picker1=='00:00:00') 
           {
              $salida->horaretorno=null;
           }
             if($request->tipo_papeleta=='1')
           {
              $salida->tipopapeleta = "A";
           }
           else
           {
              if($request->tipo_papeleta=='2')
              {
                $salida->tipopapeleta = "B";
              }
              else
              {
                $salida->tipopapeleta = "C";
              }
           }
                       
           $salida->firmasolicitante = $request->firmasol;
           $salida->firmajefe = $request->firmajefe;
           $salida->firmarrhh = $request->firmarrhh;
           $salida->observacion = $request->observacion;
           $salida->entregado = "NO";

           $mio=Salida::all();

           if($mio=="[]")
           {
              $cont=0;
           }
           else
           {
              $elige=Salida::select('*')->orderBy('id', 'desc')->take(1)->get();
              $cont=$elige[0]["id"];
           }
           return response()->json($cont+1);    
    }

    public function consultasalida(Request $request)
    {
           $salida=new Salida;
           $salida->cod_nombre = $request->nombre;
           $salida->motivo = $request->motivo;
           $salida->lugar = $request->lugar; {}
           $salida->fecha = $request->date;
           $salida->horasalida = $request->picker;
           $salida->horaretorno = $request->picker1;

           if(($request->picker=='00:00:00')&&($request->picker1=='00:00:00'))
           {
              $salida->horasalida=null;
              $salida->horaretorno=null;
           }
           if ($request->picker1=='00:00:00') 
           {
              $salida->horaretorno=null;
           }
             if($request->tipo_papeleta=='1')
           {
              $salida->tipopapeleta = "A";
           }
           else
           {
              if($request->tipo_papeleta=='2')
              {
                $salida->tipopapeleta = "B";
              }
              else
              {
                $salida->tipopapeleta = "C";
              }
           }
                       
           $salida->firmasolicitante = $request->firmasol;
           $salida->firmajefe = $request->firmajefe;
           $salida->firmarrhh = $request->firmarrhh;
           $salida->observacion = $request->observacion;
           $salida->entregado = "NO";
           $salida->save();

           $elige=Salida::select('*')->orderBy('id', 'desc')->take(1)->get();
           $cont=$elige[0]["id"];
           return response()->json($cont);    
    }


public function consultasalid2(Request $request)
    {
           $notificacion=new Notificacion;

           $notificacion->a = 'Jorge del Castillo';
           $notificacion->de = $request->nombre;
           $notificacion->motivon = $request->motivo;
           $notificacion->lugarn = $request->lugar;
           $notificacion->fechan = $request->date;
           $notificacion->horasalidan = $request->picker;
           $notificacion->horaretornon = $request->picker1;

           if(($request->picker=='00:00:00')&&($request->picker1=='00:00:00'))
           {
              $notificacion->horasalidan=null;
              $notificacion->horaretornon=null;
           }
           if ($request->picker1=='00:00:00') 
           {
              $notificacion->horaretornon=null;
           }
           $notificacion->firmasolicitanten = $request->firmasol;
           $notificacion->firmajefen = $request->firmajefe;
           $notificacion->firmarrhhn = $request->firmarrhh;
           $notificacion->save();   
    }

    public function consultacons1(Request $request)
    {
        $login=$request->usuario;
        $password=$request->contraseña;
        $datos=Usuario::select('*')->where('usuario','=',$login)->where('contraseña','like',$password)->get();
        $DAVID=$datos[0]["nombre"] . " " . $datos[0]["paterno"] . " " . $datos[0]["materno"];

        //return response()->json($datos);
        return response()->json($DAVID);
    } 

        public function consultacons(Request $request)
    {
        $login=$request->usuario;
        $password=$request->contraseña;
        $datos=Usuario::select('*')->where('usuario','LIKE BINARY',$login)->where('contraseña','LIKE BINARY',$password)->where('estado','like','activo')->get();
       return response()->json($datos);
    } 
     public function consultacons4(Request $request)
    {
        $datos=Notificacion::select('*')->get();
       return response()->json($datos);
    } 

     public function consultacons3(Request $request)
    {
      $logino=$request->usuarios;
        $passwordo=$request->contraseñas;
       $ccc=Usuario::select('foto')->where('usuario','=',$logino)->where('contraseña','=',$passwordo)->where('estado','like','activo')->get();
     $name = explode(':',$ccc);
       $cc = explode('}',$name[1]);
       $ccc = explode('"',$cc[0]);

       $url = "E:/defaults/".$ccc[1];

   $contents = file_get_contents($url); 

     $string = base64_encode($contents);

       return response()->json($string);
    } 


      
        public function solio(Request $request)
    {
        $ciss=$request->co;
        $datos=Usuario::select('*')->where('id','=', $ciss)->get();
        return response()->json($datos); 
    }

       public function getusuariocontra(Request $request)
    {
        $cedula=$request->ide;
        $datos=Usuario::select('*')->where('id','=', $cedula)->get();
        return response()->json($datos); 
    }

    public function consultacons2(Request $request)
    {
        $login=$request->usuario;
        $password=$request->contraseña;
        $datos=Usuario::select('*')->where('usuario','=',$login)->where('contraseña','like',$password)->get();
        $CI=$datos[0]["id"];
        return response()->json($CI);
    }

     public function obtienedepa(Request $request)
      {
          $login=$request->usuariodepa;
          $password=$request->contraseñadepa;
          $datos=Usuario::select('*')->where('usuario','=',$login)->where('contraseña','like',$password)->get();
          $DEPA=$datos[0]["departamento"];
          return response()->json($DEPA);
      }

    public function consultaopesalida(Request $request)
    {
        $ci=$request->carnet;
        $valor=Salida::select('*')->where('cod_nombre','=',$ci)->get();
        return response()->json($valor);
    } 

  public function consultafechasal(Request $request)
    {
        $fec=$request->fechahoy;
        $valor=Salida::select('*')->where('fecha','=',$fec)->get();
        return response()->json($valor);
    } 
  

    public function consultactualiza(Request $request)
    {
        $id=$request->carnetactual;
        $usuar=Usuario::where('id','=',$id)->first();
        $usuar->usuario=$request->nuevo_login;
        $usuar->contraseña=$request->nuevo_password;
        $usuar->save();
        return response()->json($usuar);
    }

    public function actualizapapel(Request $request)
    {
        $id=$request->id;
        $papeleta=Salida::where('id','=',$id)->first();
        $papeleta->horasalida=$request->horasalida;
        $papeleta->horaretorno=$request->horaretorno;
        $papeleta->observacion=$request->observacion;
        $papeleta->save(); 
        return response()->json($papeleta);
    }


    public function actualizapapelentregado(Request $request)
    {
        $id=$request->id;
        $papeleta=Salida::where('id','=',$id)->first();
        $papeleta->entregado=$request->entregado;

        //PARA REGISTRAR LA HORA DE LA PAPELETA
        $carnet_ide=$request->cod_nombre;
        $fechita=$request->fecha;
        $horasal=$request->horasalida;
        $horaret=$request->horaretorno;
        $registra_entrada=new Asistencia();
        $registra_entrada->fecha=$fechita;
        $registra_entrada->hora=$horasal;
        $registra_entrada->ci=$carnet_ide;



        $registra_salida=new Asistencia();
        $registra_salida->fecha=$fechita;
        $registra_salida->hora=$horaret;
        $registra_salida->ci=$carnet_ide;

        $registra_entrada->save();$registra_salida->save();
        $papeleta->save(); 
        return response()->json($papeleta);



    }
    public function actualizausuestado(Request $request)
    {
      $id=$request->id;
        $usuario=Usuario::where('id','=',$id)->first();
        $usuario->estado=$request->estado;
        $usuario->save(); 
        return response()->json($usuario);
    }

    public function consultasuperusuarios(Request $request)
    {
        $dirdaf=Usuario::select('*')->where('cargo','=','DIRECTOR ADMINISTRATIVO FINANCIERO')->where('estado','like','activo')->get();
        $dirdcf=Usuario::select('*')->where('cargo','=','DIRECTOR DE CONTROL Y FISCALIZACION')->where('estado','like','activo')->get();
        $dirdj=Usuario::select('*')->where('cargo','=','DIRECTOR JURIDICO')->where('estado','like','activo')->get();
        $dirdge=Usuario::select('*')->where('cargo','=','DIRECTOR GENERAL EJECUTIVO')->where('estado','like','activo')->get();
        $tecnicorrhh=Usuario::select('*')->where('cargo','=','TECNICO ADMINISTRATIVO FINANCIERO')->where('estado','like','activo')->get();
        $analistarrhh=Usuario::select('*')->where('cargo','=','ANALISTA DE RECURSOS HUMANOS')->where('estado','like','activo')->get();
        $apoyos=Usuario::select('*')->where('cargo','LIKE','%APOYO%')->where('estado','like','activo')->get();
        return response()->json(array('DAF' => $dirdaf,'DCF' => $dirdcf,'DJ' => $dirdj,'DGE'=>$dirdge,'APOYOS'=>$apoyos,'RRHH' => $tecnicorrhh,'AUXRRHH' => $analistarrhh));
    }


    public function subir(Request $request)
    {
        $id=$request->cii;
        $usuar=Usuario::where('id','=',$id)->first();
        $usuar->foto=$request->nameimg;
        $usuar->save();
        $img=$request->imag;
        $name = explode(',',$img);
        $image = base64_decode($name[1]);
        $extencion='jpg';
        $fileName=time().'.'.$extencion;
        $path='E:/defaults/'.$request->nameimg;
        file_put_contents($path, $image);
      return response()->json($name[1]);

    }

}
