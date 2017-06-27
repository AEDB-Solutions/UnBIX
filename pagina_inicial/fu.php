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
            <li style="color: blue;"><a href="fu.html" style="color: black;">Reclamações</a></li>
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
            <li><a href="#" style="color: black;">Relatório estatístico</a></li>
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
  <h2>Reclamações</h2>
  <h3>
      <form action="index1.php" method="post">
        <button type="submit" href="script.js" name="botao-mapa" value="Ver todos no mapa" onclick="create_marker(lat,long,type,map)">ver</button>
      </form>
      <script type="text/javascript">
          function create_marker(lat,long,type,map)
          {
            var key_point_location = new google.maps.LatLng(lat,long);
            var marker = new google.maps.Marker({position: key_point_location});
  
            if(type == 0)
            {
               //normal// personalize
            }
            else if(type == 1)
             {
                //ponto chave//personalize
             }  

             marker.setMap(map);

              return marker;
          }  
  
    

      </script>
  </h3>
  <p>*pode ter algo escrito caso precise*</p>
  <p>*as cores vão ser definidas*</p>
  <table class="table" id="table">
    <thead>
      <tr>
      <th>Título</th>
      <th>Descrição</th>
      <th>Categoria</th>
      <th>Emergência</th>
      <th>Local</th>
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


  <script type="text/javascript">


    
//var x = document.getElementById("form").elements[0].value;

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var x = getParameterByName('categ');
console.log(x);

switch(x){
  case "Infraestrutura":
    var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Infraestrutura");
    break;
  case "Seguranca":
    var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Seguranca");
    break;
  case "Iluminacao":
    var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Iluminacao");
    break;
  case "Bebedouro":
    var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Bebedouro");
    break;
  case "Banheiro":
    var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Banheiro");
    break;
  case "Outros":
    var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Outros");
    break;
}

/*if (x = "Infraestrutura"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Infraestrutura");
} else if (x = "Seguranca"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Seguranca");
} else if (x = "Iluminacao"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Iluminacao");
} else if (x = "Bebedouro"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Bebedouro");
} else if (x = "Banheiro"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Banheiro");
} else if (x = "Outros"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Outros");
} */


//var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ =Infraestrutura");
console.log(info);
  /*var reclams = [
  {'cat': "Banheiro", 'rec': "Tá vazando"},
  {'cat': "Banheiro1", 'rec': "Tá vazando5"},
  {'cat': "Banheiro2", 'rec': "Tá vazando6"},
  {'cat': "Banheiro3", 'rec': "Tá vazando7"},
  {'cat': "Banheiro4", 'rec': "Tá vazando8ss"}
  ]
*/
var modelo = "<tr>\
    <td>{{ele1}}</td>\
    <td>{{ele2}}</td>\
    <td>{{ele3}}</td>\
    <td>{{ele4}}</td>\
    <td>{{ele5}}</td>\
  </tr>";
console.log(info.length)

for (var i = 0; i < info.length; i++) 
{
    document.getElementById("table").innerHTML += modelo.replace("{{ele1}}", info[i].Titulo).replace("{{ele2}}", info[i].Descricao).replace("{{ele3}}", info[i].Categoria).replace("{{ele4}}", info[i].Emergencia).replace("{{ele5}}", info[i].descricao)
}

function requests(host, method = "GET", data = {}) //ERA OBJETO
{
    var content = null
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
    if(this.readyState == 4 && this.status == 200) 
    {
     content = this.responseText
    }
    };

    xhttp.open(method, host, false)
    
    if(method = "GET")
    xhttp.send()
    
    else
    {
      xhttp.setRequestHeader("Content-Type", "application/json");
      xhttp.send(JSON.stringify(data));
      //xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    }
    
    return content;
}
function getting_db_info(host)
{
  var server_awnser = requests(host);

  //console.log("hola", JSON.parse(server_awnser));
  
  return JSON.parse(server_awnser);
}

  </script> 
</body>
</html>
