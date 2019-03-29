<?php
// Include data base connect class
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db_connect.php");
 // Connecting to database 
$db = new DB_CONNECT();	

$hora = array();
$temperatura = array();
$i = 0;
$sql = "select * from temp";
$resultado = mysql_query($sql);
while ($row = mysql_fetch_object($resultado)){
	$hora[$i] = $row->hora;
    $temperatura[$i] = $row->temperatura;
    $i=$i+1;
    $u=100;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> <title>Gráfico Temperatura quarto do níkola</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta http-equiv='refresh' content='60' URL=''>    
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!-- JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Google Chart -->  
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <h3 align="center">Temperatura Quarto do níkola</h3>

<!-- Div do Gráfico -->
<div class="container" style="height: 100%; width: 100%" id="chart_div"></div>

<br><br>


</body>
<script>
//Script do Google que define o TIPO do gráfico
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBackgroundColor);

//Define o tipo de coluna e o nome
function drawBackgroundColor() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'hora');
      data.addColumn('number', 'temperatura');
    
      data.addRows(<?php echo $i ?>);
		
		<?php 
		$k = $i;
		$kk = $k - 100;
		for ($ii = 0; $ii< $k; $ii++) {
			?>
			
			data.setValue(<?php echo $ii ?>, 0, '<?php echo $hora[$ii] ?>');
			data.setValue(<?php echo $ii ?>, 1, <?php echo $temperatura[$ii] ?>);
			<?php
			}
			?>


      //Opções do gráfico:    
      var options = {
        hAxis: {
          title: 'Hora do servidor'
        },
        vAxis: {
          title: 'Temperatura ºC'
        },
        backgroundColor: '#ffff'
      };

      //Criação do Gráfico  
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

</script>
</html>
