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
      <a class="navbar-brand" href="#">
      	<img src="http://i.imgur.com/RJTalj1.png" alt="UnBIX" style="height: 30px; width: 100px">
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class=""><a href="#" style="color: white;">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">Menu <span class="caret"></span></a>
          <ul class="dropdown-menu w3-green">
            <li style="color: blue;"><a href="#" style="color: black;">Reclamações</a></li>
            <li><a href="#" style="color: black;">Busca por Categoria</a></li>
            <li><a href="#" style="color: black;">Buscar local específico</a></li>
          </ul>
        </li>
      </ul>


      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        	<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
          <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name'] ?> </a>
        	<ul class="dropdown-menu w3-green">
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
     <main >
       <!-- <p><button onclick="getLocation()"  style="position: absolute; left:300px; top:90px">Inserir reclamação na localização atual</button></p> 
        <div id="out"></div>

          <p id="demo"></p> -->



        <form action="savelocation.php" method="post" id="form" style='display:none'>
  <table>
          <tr><td></td> <td><input type="text" name="lat" id="lat"> </td> </tr>
          <tr><td></td> <td><input type="text" name="long" id="long"> </td> </tr>
          <tr><td>Título: </td> <td><input type="text" name = "Titulo" id= "Titulo"/> </td> </tr>
          <tr><td>Descrição:</td> <td><input type="text" name = "Descricao" id='Descricao'/> </td> </tr>
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

            <div id="map-canvas"></div>
            <script src="script.js"></script>
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