<!DOCTYPE html>
<html>
<head>
	<title>vale</title>
	<style type="text/css">
	table.paleBlueRows  
  {
  font-family: "Roboto", Times, serif;
  border: 1px solid #FFFFFF;
  width: 700px;
  height: 200px;
  text-align: center;
  border-collapse: collapse;
  }
  table.paleBlueRows td, table.paleBlueRows th 
  {
    border: 1px solid #FFFFFF;
    padding: 2px 2px;
  }
  table.paleBlueRows tbody td 
  {
    font-size: 12px;
  }
  table.paleBlueRows tr:nth-child(even) 
  {
    background: #D0E4F5;
  }
  table.paleBlueRows thead 
  {
    background: #0B6FA4;
    border-bottom: 5px solid #FFFFFF;
  }
  table.paleBlueRows thead th 
  {
    font-size: 12px;
    font-weight: bold;
    color: #FFFFFF;
    text-align: center;
    border-left: 2px solid #FFFFFF;
  }
  table.paleBlueRows thead th:first-child 
  {
    border-left: none;
  }

  table.paleBlueRows tfoot 
  {
    font-size: 14px;
    font-weight: bold;
    color: #333333;
    background: #D0E4F5;
    border-top: 3px solid #444444;
  }
  table.paleBlueRows tfoot td 
  {
    font-size: 14px;
  }
	</style>
</head>
<body>
	<center><h3 style="font-family:roboto;">REPORTE PAPELETAS AFCOOP</h3></center>
	<!--<img src="logos.png" width="300" height="100">-->
	 <table class="paleBlueRows" style="margin: 0 auto;">
        <thead>
            <tr>
                <th>NRO</th>
                <th>CI</th>
                <th>MOTIVO</th>
                <th>LUGAR</th>
                <th>FECHA</th>
                <th>HORA SALIDA/U</th>
                <th>HORA RETORNO</th>
            </tr>                            
        </thead>
        <tbody>
            @foreach($pasantes as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->cod_nombre }}</td>
                <td>{{ $product->motivo }}</td>
                <td class="text-right">{{ $product->lugar }}</td>
                <td>{{ $product->fecha }}</td>
                <td>{{ $product->horasalida }}</td>
                <td>{{ $product->horaretorno }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>