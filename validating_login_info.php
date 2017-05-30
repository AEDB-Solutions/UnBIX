<?php

header("Content-Type: text/html; charset=ISO-8859-1", true);

include("database.php");
include("class_database_query.php");

function login_check_info()
{

	$erros = array('matriculaErr' => ' ','passErr' => ' ', 'generalErr' => ' ');

	analysing_post_empty('matricula','Matricula', $erros);
	analysing_post_empty('pass','Senha', $erros);

	$password = $_POST['pass'];
	$mat = $_POST['matricula'];

	$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");

	try_login($mat, $password, $db_colluns, $erros);
}

function analysing_post_empty($type, $db_collun, &$erros)
{
		$key = $type."Err";

	if(empty($_POST[$type]))
	{
		$Err = "Campo Obrigatório: $type";
		$erros[$key] = $Err;
	}
}

function try_login($matricula , $pass, $db_colluns, $erros)
{
	if(validate_login_info($matricula, $pass, $db_colluns))
	{
		setting_basic_info($matricula, $pass);
		echo '<html><head><meta http-equiv="Refresh" content="1;pagina_inicial/index1.html"></head></html>';
		exit;
	}

	else if($erros['passErr'] == ' ' && $erros['matriculaErr'] == ' ')
	$erros['generalErr'] = 'Matricula ou senha Inválida!';

//imprimindo erros depois daqui
	printing_erros($erros);
}

function printing_erros($erros)
{
	foreach ($erros as $term)
	{
		if($term != ' ')
		{
				echo "<script>alert('$term');</script>";
				echo '<html><head><meta http-equiv="Refresh" content="1;tela_login.php"></head></html>';
				break;
		}
		//header()
	}
}

function validate_login_info($matricula, $senha, $db_colluns)
{
	//$pdo = new Database;//objet database//nao funciona?
	$db = Database::connect();

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$cript_senha= hash('sha256',$senha);
	$query = "Select * from Users where {$db_colluns[3]} = ?  and {$db_colluns[5]} = ?;";
	$finds = $db->prepare($query);
	$finds->execute(array($matricula, $cript_senha));
	$rows = $finds->rowCount();

	if($rows > 0)
	{
		return true;
	}

	return false;
}

function setting_basic_info($matricula, $senha)
{
	$row = picking_user_datas($matricula, $senha);

	$_SESSION['id'] = $row['Userid'];
	$_SESSION['name'] = $row['Nome'];
	$_SESSION['matricula'] = $row['Matricula'];
	$_SESSION['email'] = $row['Email'];


}

function picking_user_datas($matricula, $senha)
{
	$find_row = new db_query();
	$find_row->set_find_row("select Matricula,Nome,Email,Userid from Users WHERE Matricula = ? and Senha = ?",array($matricula, hash('sha256',$senha)));
	$row = $find_row->get_row();

	return $row;
}

?>
