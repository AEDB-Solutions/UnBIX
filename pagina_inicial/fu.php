<?php
session_start();
if(empty($_SESSION['id'])) {
    header("location:../index.php"); 
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Busca por categoria</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="tabela.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed w3-green" style="position: top">
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
            <li><a href="#" style="color: black; width: 200px">Melhor caminho <span class="caret"></span></a>
              <ul class="dropdown-submenu">
                <form action="" method="get">
                  <input type="checkbox" name="opcao" value="Banheiro F"> Banheiro Feminino </br>
                  <input type="checkbox" name="opcao" value="Banheiro M"> Banheiro Masculino </br>
                  <input type="checkbox" name="opcao" value="Bebedouro"> Bebedouro </br>
                  <label id="raio">Raio: </label>
                  <input type="text" id="raio" name="raio"  style="width: 50px;"> (metros)
                  <input class="w3-hover-black" type="submit" value="Calcular!">
                </form>
              </ul>
            </li>
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
     <main >
       <!-- <p><button onclick="getLocation()"  style="position: absolute; left:300px; top:90px">Inserir reclamação na localização atual</button></p> 
        <div id="out"></div>
          <p id="demo"></p> -->


<div class="conteiner">
  <h3>
      <div id="butao" align="center">
      <form action="indexbusca.php" method="post">
        <button name="botao-mapa" id="botao" style="background-color: #0099ff; border: double; border-color: white; color: white; padding: 15px 32px; text-align:center; text-decoration: none; display: inline-block;font-size: 16px;"> <span class="glyphicon glyphicon-globe"></span>Ver no mapa</button>
      </form>
     </div> 
  
      </h3>
  
  <table class="table" id="table">
    <thead>
      <tr>
      <th>Título</th>
      <th>Descrição</th>
      <th>Categoria</th>
      <th>Emergência</th>
      <th>Local</th>
      <th>KEY</th>
    </thead>
    <tbody>
      <tr>
      </tr>
      <tr class="success">
        
      </tr>
      <tr class="danger">
        
      </tr>
      <tr class="info">
        
      </tr>
      <tr class="warning">
        
      </tr>
      <tr class="active">
        
      </tr>
    </tbody>  
  </table>
  
</div>

  <script type="text/javascript" src="scripttabel.js"></script>
            <div id="map-canvas" style="width:; height: 400px;"></div>
            <script src="scrittabel.js"></script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1WMWZn7OQEGUH0lCnd-3i9krdCkA8LoY&callback=initMap" type="text/javascript"></script>
</body>
</html>