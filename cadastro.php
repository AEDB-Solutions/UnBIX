<!DOCTYPE html>

<html>
 <head>
 <title> UNBIX - Cadastro </title>
 <link href="cadastrodef.css" rel="stylesheet">
 <meta name="description" content="Faça aqui seu cadastro no UnBix!">
 <meta http-equiv="content-Type" content="text/html; charset=ISO-8859-1" />

 <script language="text/javascript" type="text/javascript">
  function validar() {

  var mat = document.forms["cad"]["matricula"].value;
  var soNumeros = /^[0-9]+$/;

         if (document.forms["cad"]["nome"].value == "") {
            alert("Campo Obrigatorio: Nome");
            return false;
         }
        if (document.forms["cad"]["email"].value == "") {
     alert("Campo Obrigatorio: e-mail");
            return false;
         }
        if (mat.length < 9) {
            alert("Campo Matricula: deve conter 9 caracteres numericos");
            return false;
     }
  if (document.forms["cad"]["genero"].value == "") {
         alert("Campo Obrigatorio: Genero");
         return false;
     }
  if (!mat.match(soNumeros)) {
  document.forms["cad"]["matricula"].value="";
         alert("Campo Matricula: Utilizar somente numeros");
         return false;
     }
  if (document.forms["cad"]["senha"].value != document.forms["cad"]["confsenha"].value) {
  alert("Campo senha diferente de campo confirma senha");
         return false;
     }
    if (document.forms["cad"]["senha"].value == "") {
         alert("Campo Obrigatorio: Senha");
         return false;
     }
 }
</script>
</head>


<body>
<div align="center"> 	
  <img src="http://imgur.com/UzU7KBX.png" alt="UNBIX - Logo" style="width:auto; height:auto;">
</div>	
<form action="confirma.php" method="post" name="cad" onsubmit="return validar();">
<!-- DADOS DE CADASTRO -->
<hgroup>
  <h1>Cadastro</h1>
</hgroup>
<form>

  <div class="group">
    <input type="text" name = 'nome'><span class="highlight"></span><span class="bar"></span>
    <label>Nome</label>
  </div>

  <div class="group">
    <input type="email" name = 'email'><span class="highlight"></span><span class="bar"></span>
    <label>Email</label>
  </div>

  <div class="group">
  <td>
  <select name="curso">
	 <?php
		       header("Content-Type: text/html; charset=ISO-8859-1", true);
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM Cursos ORDER BY 2';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<option value="' . $row['Cursoid'] . '">' . $row['Curso_Nome'] . '</option>';
                       }
                       Database::disconnect();
          ?>
	</select>
   </td>
  </tr>
</div>


  <div class="group">
    <input type="text" maxlength="9" name="matricula"><span class="highlight"></span><span class="bar"></span>
    <label>Matricula</label>
  </div>


  <tr>
  	<td>
  		<label for="genero">G&ecirc;nero: </label>
  	</td>
  	<td align="left">
 	 <input type="radio" name="genero" value="M"> M
 	 <input type="radio" name="genero" value="F"> F
 	 <input type="radio" name="genero" value="Outro"> Outro
  	</td>
  </tr>


  <div class="group">
    <input type="password" name="senha"><span class="highlight"></span><span class="bar"></span>
    <label>Senha</label>
  </div>

  <div class="group">
    <input type="password" name="confsenha"><span class="highlight"></span><span class="bar"></span>
    <label>Confirmar senha</label>
  </div>

  <button type="submit" class="button buttonBlue">Enviar
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>

</form>
<!--    <footer><a href="http://www.polymer-project.org/" target="_blank"><img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>
        <p>You Gotta Love <a href="http://www.polymer-project.org/" target="_blank">Google</a></p>
        </footer>
-->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-gears" style="font-size:36px;color:red"></i>
    <i class="fa fa-terminal" style="font-size:36px;color:orange"></i>
    <i class="fa fa-check" style="font-size:36px;color:yellow"></i>
    <i class="fa fa-map-o" style="font-size:36px;color:green"></i>
    <i class="fa fa-thumb-tack" style="font-size:36px;color:blue"></i>
    <i class="fa fa-thumbs-up" style="font-size:36px;color:purple"></i>
</form>


 </body>
</html>


