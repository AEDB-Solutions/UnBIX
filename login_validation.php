<?php

include("validating_login_info.php");

$erros = array('matriculaErr' => ' ','passErr' => ' ');

function analysing_post($type, $db_collun, &$erros)
{
		$key = $type."Err";

	if(empty($_POST[$type]))
	{
		$Err = "Please insert a $type!";
		$erros[$key] = $Err;
	}

	else
	{
		$search = $_POST[$type];

		if(!validate_login_information($search,$db_collun))
		{
			if($erros['matriculaErr'] == ' ')//so vai dizer que a matricula é invalida mesmo se a senha existir
			{
				$Err = "$type Invalid!";
				$erros[$key] = $Err;
			}
		}
	}
}


analysing_post('matricula','Matricula', $erros);
analysing_post('pass','Senha', $erros);

$matriculaErr = $erros['matriculaErr'];
$passErr = $erros['passErr'];

$pass = $_POST['pass'];
$matricula = $_POST['matricula'];
$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");

if($erros['matriculaErr'] == ' ' && $erros['passErr'] != "Please insert a pass!") //&& $erros['passErr'] == ' ')
{
	if(validate_all_info($matricula, $pass, $db_colluns))
	echo "sucesso!";
	
	else
	$passErr = "pass Invalid!";//a senha e o login fazem sentido mas nao para uma mesma linha do banco

}

if($passErr != ' ')
{
	echo "<script>alert('$passErr');</script>";
}
if($matriculaErr != ' ')
{
	echo "<script>alert('$matriculaErr');</script>";
}

?>

<html>
<head>
<meta http-equiv="Refresh" content="1;tela_login.php">
</head>
</html>
