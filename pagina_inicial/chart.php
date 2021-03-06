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
  <link rel="stylesheet" href="tabela.css">	
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
          title: ''
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
  </script>


</head>
<body>
	style>
    input[type="submit"]
              {
                background-color: #4CAF50;
                margin-top: 10px;
                width: 80px;
                height: 40px;
                border: none;
                margin-bottom: 10px;
                color: white;
                style="margin-left: 10px;
            }
    </style>

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
<li><a href="tabelareclam.php" style="color: black;">Reclamações</a></li>
            <li class="dropdown-submenu">
              <a class="test" data-toggle="dropdown" href="#" style="color: black;">Busca por Categoria<span class="caret"></span></a>
              <ul class="dropdown-submenu">
              <li><a href="fu.php?categ=Infraestrutura" style="color: black;">Infraestrutura</a></li>
              <li><a href="fu.php?categ=Seguranca" style="color: black;">Segurança</a></li>
              <li><a href="fu.php?categ=Iluminacao" style="color: black;">Iluminação</a></li>
              <li><a href="fu.php?categ=Bebedouro" style="color: black;">Bebedouro</a></li>
              <li><a href="fu.php?categ=Banheiro" style="color: black;">Banheiro</a></li>
              <li><a href="fu.php?categ=Outro" style="color: black;">Outros</a></li>

              </ul>


            </li>
          </ul>

          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">Ferramentas<span class="caret"></span></a>
          <ul class="dropdown-menu w3-white">
            <li><a href="chart.php" style="color: black;">Relatório estatístico</a></li>
            <li><a href="#" style="color: black; width: 200px">Melhor caminho <span class="caret"></span></a>
              <ul class="dropdown-submenu">
                <form action="tabelcaminho.php">
                <tr><td>Type:</td> <td><select name = "Categoria" id ='Categoria'> +
                <option value='BanheirM' id = 'Banheiro_m' SELECTED>Banheiro M </option>
                <option value='BanheirF'  id = 'Baneiro_f' SELECTED> Banheiro F</option>
                <option value = 'Bebedouro'  id = 'bebedouro' SELCTED>Bebedouro</option>
                </select> </td></tr>
                  <label id="raio">Raio: </label>
                  <input type="text" id="raio" name="raio" style="width: 50px;"> (metros)
                  <input type="submit" id="botao2" value="Calcular!">
                </form>
              </ul>
            </li>
          </ul>
        </li>
      </ul>


      <ul class="nav navbar-nav navbar-right">
  <li class=""><a id="user_pos" href="#" style="color: white;">Reportar a partir da localização atual</a></li>       
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
          <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name'] ?> </a>
          <ul class="dropdown-menu w3-white">
              <li><a href="tabeluser.php" style="color: black;">Minhas reclamações</a></li>
          </ul>
        </li>
        <li><a href="logoff.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Log off</a></li>
      </ul>
    </div>
  </div>
</nav>
     <main >
       <!-- <p><button onclick="getLocation()"  style="position: absolute; left:300px; top:90px">Inserir reclamação na localização atual</button></p> 
        <div id="out"></div>

          <p id="demo"></p> -->



       <form action="savelocation.php" method="post" id="form" style='display:none'>
  <table>

          <input type="hidden" name="lat" id="user_id_session" value = 1 >
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
         </main>   

      
      <div class="w3-content" style="width: 450px; height: 300px; margin-top: 60px; line-height: 25px;" align="left">
            <h1 style="font-size: 28px; line-height: 20px;">Relatórios Estatísticos</h1>

            <h2 style="font-size: 16px; line-height: 20px;">Acompanhe em tempo real a porcentagem de problemas referentes a cada categoria</h2>
            <h2 style="font-size: 16px; line-height: 20px;">Com o relatório estatístico você pode:</h2>
            <li>Ficar por dentro dos problemas da Universidade</li>
            <li>Acompanhar quais problemas estão em maior porcentagem</li>
            <li>Tirar conclusões e levar para a reitoria resolver</li>


      <div id="piechart" class="w3-content" style="width: 600px; height: 400px; position: fixed; "></div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	      

    
      

  </body>
</html>
