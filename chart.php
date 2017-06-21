<?php

	include "database.php";
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select Categoria , count(*) as Complaints from Complaints group by Categoria";
	$q = $pdo->prepare($sql);
	$q->execute();
	$value = $q->fetchall(PDO::FETCH_OBJ);
	
	//var_dump($value);
	$list = ["['Bitch', 'Fuck']"];
	foreach($value as $row)
	{
		array_push($list, "['".$row->Categoria."',".$row->Complaints."]");
	}
	$list_str = "[" .  implode(',', $list) . "]";

?>


<html>
  <head>
    
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

    /*var list = [
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]*/

    var list = <?php echo $list_str;?> ; 
    console.log(list)

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable(list);

        var options = {
          title: 'Complaints por Categoria'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </body>
</html>
