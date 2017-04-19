	<?php

header("Content-Type: text/html; charset=ISO-8859-1", true);

include("database.php");


function analysing_post_empty($type, $db_collun, &$erros)
{
		$key = $type."Err";

	if(empty($_POST[$type]))
	{
		$Err = "Campo Obrigatório: $type";
		$erros[$key] = $Err;
	}
}

function validate_all_info($matricula, $senha, $db_colluns)
{
	//$pdo = new Database;//objet database//nao funciona?
	$db = Database::connect();	

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$cript_senha= hash('sha256',$senha);

	$query = "Select * from Users where {$db_colluns[3]} = '{$matricula}' and {$db_colluns[5]} = '{$cript_senha}';";
	$finds = $db->prepare($query);
	$finds->execute();
	$rows = $finds->rowCount();

	if($rows > 0)
	{
		Database::disconnect();
			return true;
	}
		Database::disconnect();
		return false;
}

?>
