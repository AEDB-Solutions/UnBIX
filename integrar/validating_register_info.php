	<?php 

header("Content-Type: text/html; charset=ISO-8859-1", true);

	include("database.php");

	function validating_posts($post_name,&$erros)
	{
			$key = $post_name."Err";
			
			if(empty($_POST[$post_name]))
			$erros[$key] = "Insert a $post_name !";
			
			else
			{
				if($post_name == 'nome' || $post_name == 'email' || $post_name == 'matricula' || $post_name == 'senha')
				{
					$user_choice = $_POST[$post_name];
					define_validator($post_name, $user_choice, $erros, $key);
				}
			}	
	}//qualquer coisa coloque a funcao acima no outro arquivo

	function define_validator($post_name, $user_choice , &$erros, $key)
	{
		switch($post_name)
		{
			case 'nome': validating_name($user_choice, $erros, $key);
				break;

			case 'email': validating_email($user_choice, $erros, $key);
				break;

			case 'matricula': validating_matricula($user_choice, $erros, $key);
				break;

			case 'senha': validating_pass($user_choice, $erros, $key);
				break;
		}
	}


	function check_on_database($to_check,$db_collun)//bool
	{

		 $db = Database::connect();
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 
		 $query = "select ".$db_collun." from Users;";
		 $search = $db->query($query);

		 foreach($search as $row)
		 {
		 	if($row[$db_collun] == $to_check)
		 	{
		 		Database::disconnect();
		 		return true;
		 	}

		 }

		 		Database::disconnect();
		 		return false;
	}

	
	function validating_name($name,&$erros,$key)
	{
		 if(!preg_match("/^[a-zA-Z ]*$/",$name))
		 $erros[$key] = "Only letters and white space allowed!";	
	}

	function validating_email($email,&$erros,$key)
	{
		$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");

		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
 		$erros[$key] = "Invalid email format!";

 		else if(check_on_database($email, $db_colluns[4]))
 		$erros[$key] = "Email already registered!";

	}

	function validating_matricula($matricula, &$erros, $key)
	{
		$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");

		if(strlen($matricula) != 9 || is_numeric($matricula) == false)
		$erros[$key] = "registered can only have nine numbers!";

		else if(check_on_database($matricula, $db_colluns[3]))
		$erros[$key] = "Register already registered!";

	}
	
	function validating_pass($pass,&$erros,$key)
	{

		if(!empty($_POST['confsenha']))
			if($pass != $_POST['confsenha'])
				$erros['confsenha'] = "Confirmation password not equal to pass"; 

	}

	function no_erro($erros)
	{
		
		foreach($erros as $term)
		{
			if($term != ' ')
			return false;
		}
			return true;
	}

 ?>
