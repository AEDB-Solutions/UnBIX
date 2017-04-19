<?php

include("validating_login_info.php");

$erros = array('matriculaErr' => ' ','passErr' => ' ');

analysing_post_empty('matricula','Matricula', $erros);
analysing_post_empty('pass','Senha', $erros);

$matriculaErr = $erros['matriculaErr'];
$passErr = $erros['passErr'];

$pass = $_POST['pass'];
$matricula = $_POST['matricula'];
$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");
$generalErr = ' ';

	if(validate_all_info($matricula, $pass, $db_colluns))
	{
		echo '<html><head><meta http-equiv="Refresh" content="1;mapa.html"></head></html>';
		exit;
	}

	else if($passErr == ' ' && $matriculaErr == ' ')
	$generalErr = 'Matricula ou senha Inválida!';

if($generalErr != ' ')
	echo "<script>alert('$generalErr');</script>";

else if($matriculaErr != ' ')
	echo "<script>alert('$matriculaErr');</script>";

else if($passErr != ' ')
	echo "<script>alert('$passErr');</script>";

?>

<html>
<head>
<meta http-equiv="Refresh" content="1;tela_login.php">
</head>
</html>
