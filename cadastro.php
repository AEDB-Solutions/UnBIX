<!DOCTYPE html>
 
<html>
 <head>
 <title> UNBIX - Cadastro </title>
 <link href="cadastro.css" rel="stylesheet">
 <meta name="description" content="Faça aqui seu cadastro no UnBix!">
 <meta http-equiv="content-Type" content="text/html; charset=ISO-8859-1" />
 </head>

 <body>
 
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
  
<form action="confirma.php" method="post" name="cad" onsubmit="return validar();">


<img src="http://i.imgur.com/U0xokZd.jpg" alt="UNBIX - Logo" style="width:700px; height:400px;">
<h1> Fa&ccedil;a aqui seu cadastro! </h1>

<!-- DADOS DE LOGIN -->
<fieldset>
 <legend>Dados de login</legend>
 <table cellspacing="10">
  <tr>
   <td>
    <label for="Nome">Nome: </label>
   </td>
   <td align="left">
    <input type="text" name="nome" />
   </td>
  </tr>

  <tr>
   <td>
    <label for="Email">Email: </label>
   </td>
   <td align="left">
    <input type="email" name="email" />
   </td>
  </tr>

  <tr>
   <td>
    <label for="Curso">Curso:</label>
   </td>
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
  <tr>
   <td>
    <label for="login">Matr&iacute;cula: </label>
   </td>
   <td align="left">
    <input type="text" maxlength="9" name="matricula">
   </td>
  </tr>
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




  <tr>
   <td>
    <label for="pass">Senha: </label>
   </td>
   <td align="left">
    <input type="password" name="senha">
   </td>
  </tr>
  <tr>
   <td>
    <label for="passconfirm">Confirme a senha: </label>
   </td>
   <td align="left">
    <input type="password" name="confsenha">
   </td>
  </tr>
 </table>
</fieldset>
<br />
<input type="submit">
<input type="reset" value="Limpar">

</form>
<br /><br /><br />
 </body>
</html>
