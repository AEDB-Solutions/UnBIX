<?php

header("Content-Type: text/html; charset=ISO-8859-1", true);

include("database.php");

//$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");

function validate_login_information($to_validate, $collun_database)//to_validate(algo que deve ser verificado no banco de dados)//collundatabase(nome da coluna do banco)
{
	//$pdo = new Database;//objet database//nao funciona?
	$db = Database::connect();
	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = "select ".$collun_database." from Users;";

	foreach($db->query($query) as $row)
	{	
		if($to_validate == $row[$collun_database])
		{
			Database::disconnect();
			return true;
		}
	}
			
			Database::disconnect();
			return false;

}

function validate_all_info($matricula, $senha, $db_colluns)
{
	//$pdo = new Database;//objet database//nao funciona?
	$db = Database::connect();

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = "select *from Users;";
	$choosens = $db->query($query);

	foreach($choosens as $row)
	{
		$senha = $_POST['pass'];
		$senha_comp = hash('sha256', $senha);
		if( ($matricula == $row[$db_colluns[3]]) && ($senha_comp == $row[$db_colluns[5]]) )
		{
			Database::disconnect();
			return true;
		}	
	}		
		
		Database::disconnect();
		return false;
}

?>
