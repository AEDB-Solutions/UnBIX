<!DOCTYPE html>

<html>
 <head>
    <title> UNBIX - Cadastro </title>
    <meta name="description" content="Faça aqui seu cadastro no UnBix!">
    <link href="cadastrodef.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script language="JavaScript" src="cadastrodef.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px}
    </style>

 </head>


<body>
  <div class="w3-top">
    <div class="w3-bar w3-green w3-card-2 w3-left-align w3-large">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
      <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
      <a href="quemsomos.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Quem somos</a>
      <a href="http://www.unb.br/" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">UnB</a>
  </div>
      <img src="http://imgur.com/UzU7KBX" alt="UNBIX - Logo" style="auto; height:auto;">
      <form action="login_validation.php" method="post" id="frmLogin">



<!-- DADOS DE LOGIN -->
<form action="login_validation.php" method="post">
<hgroup>
  <h1>login</h1>
</hgroup>
<form>
  <div class="group">
    <input type="text"><span class="highlight"></span><span class="bar"></span>
    <label>Matrícula</label>
  </div>
  <div class="group">
    <input type="password"><span class="highlight"></span><span class="bar"></span>
    <label>Senha</label>
  </div>
  <button type="submit" class="button buttonBlue">Logar
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>
<!--    <footer><a href="http://www.polymer-project.org/" target="_blank"><img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>
        <p>You Gotta Love <a href="http://www.polymer-project.org/" target="_blank">Google</a></p>
        </footer>
-->
</form>
 </body>
</html>
