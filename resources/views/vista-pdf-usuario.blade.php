<!DOCTYPE html>
<html>
<head>
	<title>vale</title>
<style type="text/css">
    #customers 
    {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      font-size:10px;
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }

    #customers td, #customers th 
    {
      border: 1px solid #ddd;
      padding: 0px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}


    #customers th 
    {
      padding-top: 5px;
      padding-bottom: 5px;
      text-align: left;
      background-color: #ffffff;
      color: black;
      text-align: center;
    }

    #david{
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    }

</style>
	</head>
<body>
	<center><h3 id="david">REPORTE ASISTENCIAS</h3></center>
	<!--<img src="logos.png" width="300" height="100">-->
  <?php
  foreach($nombreusuario as $name)
  {
      echo ("<h5 id='david'>" . $name->nombre . " " . $name->paterno . " " .$name->materno . "</h6>");
      echo ("<h6 id='david'>" . $name->cargo . "</h6>");
  }
    
  ?>

	 <table id="customers">
        <thead>
            <tr>
                <th>CI</th>
                <th>FECHA</th>
                <th>HORA</th>
                <th>MINS</th>
                <th>SEG</th>
                <!--<th>PERM.</th>
                <th>LICE.</th>
                <th>ABAN.</th>
                <th>VACAC.</th>-->
            </tr>                            
        </thead>
        <tbody>
            <?php
             foreach($usuariomes as $product)
              {  
                $bandera=0;
                foreach($arraysito as $fechita )
                {
                    //echo("<p>" . $product->fecha . " == " . $fechita . "</p><br>");
                    if(($product->fecha===$fechita))
                    {
                      foreach($arraysitohora as $horita)
                      {

                        if(($product->hora===$horita))
                        {
                          $bandera=1;

                          $valor=explode(":",$horita);
                          $hora=$valor[0];
                          $min=$valor[1];


                      foreach($diascontinuos as $diascont)
                      {
                        //echo("" . $product->fecha . " <> " . $diascont . "<br>");

                        if($product->fecha!=$diascont)
                        {
                          if(intval($hora)==8)
                          {
                            $mins=(intval($min))-30;
                          }
                          if(intval($hora)==9)
                          {
                            $aumenta=30;
                            $mins=intval($min)+$aumenta;
                          }
                          if(intval($hora)==10)
                          {
                            $aumenta=90;
                            $mins=intval($min)+$aumenta;
                          }
                        }
                        else
                        {
                           if(intval($hora)==8)
                          {
                            $mins=(intval($min));
                          }
                          if(intval($hora)==9)
                          {
                            $aumenta=60;
                            $mins=intval($min)+$aumenta;
                          }
                          if(intval($hora)==10)
                          {
                            $aumenta=120;
                            $mins=intval($min)+$aumenta;
                          }
                        }
                          
                      }



                        





                          if(intval($hora)==14)
                          {
                            $mins=(intval($min))-30;
                          }
                          if(intval($hora)==15)
                          {
                            $aumenta=30;
                            $mins=intval($min)+$aumenta;
                          }
                          if(intval($hora)==16)
                          {
                            $aumenta=90;
                            $mins=intval($min)+$aumenta;
                          }
                          $segs=$valor[2];
                        }
                      }
                    }   
                }


                //if(($bandera==1)&&($cpfecha==$product->fecha)&&($cphora==$product->hora))
                  if($bandera==1)
                  {
                    echo "<tr>";
                    echo "<td style='background-color:red;color:white;'>" . $product->ci . "</td>";
                    echo "<td style='background-color:red;color:white;'>" . $product->fecha . "</td>";
                    echo "<td style='background-color:red;color:white;'>" . $product->hora . "</td>";
                    echo "<td>" . $mins . "</td>";
                    echo "<td>" . $segs . "</td>";
                   /*echo "<td>" . "-" . "</td>";
                    echo "<td>" . "-" . "</td>";
                    echo "<td>" . "-" . "</td>";
                    echo "<td>" . "-" . "</td>";           
                    echo "</tr>";*/
                    $bandera=0;
                  }
                  else
                  {
                    echo "<tr>";
                    echo "<td>" . $product->ci . "</td>";
                    echo "<td>" . $product->fecha . "</td>";
                    echo "<td>" . $product->hora . "</td>";
                    echo "<td>" . "-" ."</td>";
                    echo "<td>" . "-" ."</td>";
                    /*echo "<td>" . "-" ."</td>";
                    echo "<td>" . "-" ."</td>";
                    echo "<td>" . "-" ."</td>";
                    echo "<td>" . "-" ."</td>";*/           
                    echo "</tr>";
                  }
            }
            ?>
            
        </tbody>
    </table>
</body>
</html>