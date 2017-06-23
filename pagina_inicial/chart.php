<?php
session_start();
if(empty($_SESSION['id'])) {
    header("location:../index.php"); 
}
?>

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

<!DOCTYPE html>
<html>
<head>
	<title>Relatorios</title>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

     <link type="text/css" rel="stylesheet" href="css/materialize.min.css" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="material.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">


</head>
<body>

<!--
Foi utilizado BootStrap na pagina para poder deixar ela o mais responsiva possível;
A tag <span> é utilizada para por icones na página;
As responsividades ficam dentro de cada tag e vc seleciona usando o 'class=""';
No proprio site do bootstrap ensina como fazer bastante coisa ou, se prefirir, no site w3schools tem uns guias bem praticos para aprender;
Obs: A posicao da barra de navegacao esta com style="position: absolute;" pois assim ela fica por cima do mapa
-->

<nav class="navbar navbar-inverse navbar-fixed-top w3-green" style="position: absolute;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index1.php">
      	<img src="http://i.imgur.com/RJTalj1.png" alt="UnBIX" style="height: 30px; width: 100px">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu w3-white">
            <li style="color: blue;"><a href="fu.php" style="color: black;">Reclamações</a></li>
            <li class="dropdown-submenu">
              <a class="test" data-toggle="dropdown" href="#" style="color: black;">Busca por Categoria<span class="caret"></span></a>
              <ul class="dropdown-submenu">
              <li><a href="fu.php?categ=Infraestrutura" id="form" style="color: black;">Infraestrutura</a></li>
              <li><a href="fu.php?categ=Seguranca" id="form" style="color: black;">Segurança</a></li>
              <li><a href="fu.php?categ=Iluminacao" id="form" style="color: black;">Iluminação</a></li>
              <li><a href="fu.php?categ=Bebedouro" id="form" style="color: black;">Bebedouro</a></li>
              <li><a href="fu.php?categ=Banheiro" id="form" style="color: black;">Banheiro</a></li>
              <li><a href="fu.php?categ=Outros" id="form" style="color: black;">Outros</a></li>

              </ul>
              

            </li>
            <li><a href="#" style="color: black;">Buscar local específico</a></li>
          </ul>

          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" style="color: white;">Ferramentas<span class="caret"></span></a>
          <ul class="dropdown-menu w3-white">
            <li><a data-toggle="modal" data-target="#myModal">Melhor caminho</a></li>
            <li><a href="chart.php" style="color: black;">Relatório estatístico</a></li>
          </ul>
        </li>   
      </ul>


      <ul class="nav navbar-nav navbar-right">
	<li> <button id="user_pos" class="w3-green" style="border: none;  margin-top: 10px;">Reportar a partir da localização atual</button></li>       
        <li class="dropdown">
        	<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
          <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name'] ?> </a>
        	<ul class="dropdown-menu w3-white">
            	<li><a href="#" style="color: black;">Minhas reclamações</a></li>
            	<li><a href="#" style="color: black;">Fazer reclamação anônima</a></li>
            	<li><a href="#" style="color: black;">Configurações</a></li>
              <li><a href="#" style="color: black;">Ver perfil<span></span></a></li>
          </ul>
        </li>
        <li><a href="logoff.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Log off</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><img src="http://i.imgur.com/RJTalj1.png" alt="UnBIX" style="height: 30px; width: 100px"></h4>
        </div>
        <div class="modal-body">
              <form action="algoritmo.php">
                        <tr><td></td> <td><input type="hidden" name="lat" id="lat"> </td> </tr>
                        <tr><td></td> <td><input type="hidden" name="long" id="long"> </td> </tr>
              <p> Local a procurar: </p>
                   <input type="radio" name="categoria" value="Banheiro" checked> Banheiro<br>
                    <input type="radio" name="categoria" value="Bebedouro"> Bebedouro
              <br>
              Raio (em metros):
              <input type="number" value="raio" min="1" max="1000">
              <br>
              <input type="submit" value="Buscar">
              </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
     <main >
       <!-- <p><button onclick="getLocation()"  style="position: absolute; left:300px; top:90px">Inserir reclamação na localização atual</button></p> 
        <div id="out"></div>
          <p id="demo"></p> -->



       <form action="savelocation.php" method="post" id="form" style='display:none'>
  <table>

          <input type="hidden" name="lat" id="user_id_session" value = <?php echo $_SESSION['id']?> >
          <tr><td></td> <td><input type="hidden" name="lat" id="lat"> </td> </tr>
          <tr><td></td> <td><input type="hidden" name="long" id="long"> </td> </tr>
          <tr><td>Título do problema: </td> <td><input type="text" name = "Titulo" id= "Titulo"/> </td> </tr>
          <tr><td>Descrição da localidade:</td> <td><input type='text' name='descricao_loc' id='descricao_loc'> </td></tr>"
          <tr><td>Descrição do  problema:</td> <td><textarea name = "descricao_comp" id='descricao_comp' maxlength="140" rows="25" cols="80">Reclame aqui...</textarea>
          <style>
            textarea{
            width: 150px;
            height: 113px;
            }
          </style> </td> </tr>
          <tr><td>Type:</td> <td><select name = "Categoria" id ='Categoria'> +
                <option value='Iluminacao' SELECTED>Iluminação</option>
                <option value='Banheiro' SELECTED> Banheiro</option>
                <option value='Bebedouro'>Bebedouro</option>
                <option value='Infraestrutura'>Infraestrutura</option>
                <option value='Seguranca'>Segurança</option>
                <option value='Barulho'>Barulho</option>
                <option value='Outro'>Outro</option>
                </select> </td></tr>
            <tr><td>Emergencia:</td> <td><select name = "Emergencia" id ='Emergencia'> +
                <option value='1' SELECTED> 1 </option>
                <option value='2' > 2 </option>
                <option value='3' > 3 </option>
                <option value='4' > 4 </option>
                <option value='5' > 5 </option>
            </select> </td></tr>
     <!--     <tr><td>Curtida</td> <td><input type="text" name = "Curtida" id= "Curtida"/> </td> </tr> -->
              <tr><td></td><td><input type='submit' value='Reclame!'/></td></tr>
              
</table> 
           </form>

          

      

      <div id="piechart" style="width: 1200px; height: 800px;"></div>

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
</main>	     

  </body>
</html>
