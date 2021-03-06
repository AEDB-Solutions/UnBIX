<?php
session_start();

if(empty($_SESSION['id'])) {
    header("location:../index.php"); 
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>UnBIX</title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
              <li><a href="fu.php?categ=Infraestrutura" style="color: black;">Infraestrutura</a></li>
              <li><a href="fu.php?categ=Seguranca" style="color: black;">Segurança</a></li>
              <li><a href="fu.php?categ=Iluminacao" style="color: black;">Iluminação</a></li>
              <li><a href="fu.php?categ=Bebedouro" style="color: black;">Bebedouro</a></li>
              <li><a href="fu.php?categ=Banheiro" style="color: black;">Banheiro</a></li>
              <li><a href="fu.php?categ=Outro" style="color: black;">Outros</a></li>

              </ul>
              

            </li>
            <li><a href="#" style="color: black;">Buscar local específico</a></li>
          </ul>

          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">Ferramentas<span class="caret"></span></a>
          <ul class="dropdown-menu w3-white">
            <li><a style="color: blue;"><a href="#" style="color: black;">Melhor caminho</a></li>
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
              <li><a href="tabeluser.php" style="color: black;">Minhas reclamações</a></li>
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


            <div id="map-canvas"></div>
            <script src="scrittabel.js"></script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1WMWZn7OQEGUH0lCnd-3i9krdCkA8LoY&callback=initMap" type="text/javascript"></script>

            <!--<h4><i  style=" position: absolute;left:300px; top:130px"> Busca por CATEGORIA:</i></h4>
                <select name="busca">
                  <option value="Infraestrutura">Infraestrutura</option>
                  <option value="Seguranca">Segurança</option>
                  <option value="Iluminacao">Iluminação</option>
                  <option value="Bebedouro">Bebedouro</option>
                  <option value="Banheiro">Banheiro</option>
                  <option value="Barulho">Barulho</option>
                  <option value="Outros">Outros</option>
                </select>-->

      </main>





  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  </body>
</html>