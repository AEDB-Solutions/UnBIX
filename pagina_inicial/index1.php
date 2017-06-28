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
            <li><a href="tabelareclam.html" style="color: black;">Reclamações</a></li>
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
                <form action="" method="post">
                  <input type="checkbox" name="B" id="BF" value="Banheiro F"> Banheiro Feminino </br>
                  <input type="checkbox" name="B" value="Banheiro M"> Banheiro Masculino </br>
                  <input type="checkbox" name="B" value="Bebedouro"> Bebedouro </br>
                  <label id="raio">Raio: </label>
                  <input type="text" id="raio" name="raio"  style="width: 50px;"> (metros)
                  <input type="submit" value="Calcular!">
                </form>
              </ul>
            </li>
            <li><a href="chart.php" style="color: black;">Relatório estatístico</a></li>
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



<form action="savelocation.php" method="post" id="form" class="w3-container">
  <table>

          <input type="hidden" name="lat" id="user_id_session" value = <?php echo $_SESSION['id']?> >
          <tr><td></td> <td><input type="hidden" name="lat" id="lat"> </td> </tr>
          <tr><td></td> <td><input type="hidden" name="long" id="long"> </td> </tr>
          <tr><td>Título do problema: </td> <td><input type="text" name = "Titulo" id= "Titulo" class="w3-input w3-border" style="margin-top: 10px;"/> </td> </tr>
          <tr><td>Descrição da localidade:</td> <td><input type='text' name='descricao_loc' id='descricao_loc' class="w3-input w3-border" style="margin-top: 10px;"> </td></tr>
          <tr><td>Descrição do  problema:</td> <td><textarea name = "descricao_comp" id='descricao_comp' placeholder="Reclame aqui" class="w3-input w3-border" maxlength="140" rows="25" cols="80" style="margin-top: 10px;"></textarea>
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
              <style>
              select {
                margin-top: 15px;
                -webkit-appearance: none;  
                 -moz-appearance: none; 
                 background: url(http://www.webcis.com.br/images/imagens-noticias/select/ico-seta-appearance.gif) no-repeat #eeeeee;  /* Imagem de fundo (Seta) */
                 background-position: 218px center; 
                 background-color: white; 
                 width: 250px; 
                 height:30px; 
                 border:1px solid #ddd;
              }
              input[type="submit"]
              {
                background-color: #4CAF50;
                margin-top: 10px;
                width: 80px;
                height: 40px;
                border: none;
                margin-bottom: 10px;
                color: white;
                margin-left: 10px;
            }
		      
	     input [type="text"] {
              border-style: groove;
              margin-top: 10px;
              border-color: grey;
            }		      
            </style>   
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
