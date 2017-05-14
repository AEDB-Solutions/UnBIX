	<?php 

header("Content-Type: text/html; charset=ISO-8859-1", true);

	include("database.php");

	function registering()
	{

    	$erros = array('nomeErr' => ' ', 'emailErr' => ' ', 'matriculaErr' => ' ','senhaErr' => ' ', 'confsenhaErr' => ' ', 'cursoErr' => ' ', 'generoErr' => ' ');
    	$posts_names= array('nome','email','matricula','senha', 'confsenha', 'curso','genero');

    	for($i = 0; $i < count($posts_names); $i++)
    	validating_posts($posts_names[$i], $erros);

    	if(no_erro($erros))
       		pass_to_db();

    else
        print_register_erros($erros);
	}

	function pass_to_db()
	{
        $nome = $_POST['nome'];
        $curso = $_POST['curso'];
        $email = $_POST['email'];
        $matricula = $_POST['matricula'];
        $genero = $_POST['genero'];
        $senha_in = $_POST['senha'];
        $senha_arm = hash('sha256',$senha_in);

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Users (Nome,Curso,Email,Matricula,Genero,Senha) values(?, ?, ?, ?, ?, ?);";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$curso,$email,$matricula,$genero,$senha_arm));
            Database::disconnect();

        echo '<html><p style=" text-align:center;">Registro feito com sucesso!</p><a href="index.php"> Voltar << </a> </html>';

	}

	function print_register_erros($erros)
	{
        $emailErr = $erros['emailErr'];
        $matriculaErr = $erros['matriculaErr'];
            
        if($erros['emailErr'] != ' ')
        echo "<script>alert('$emailErr');</script>";

        else if($erros['matriculaErr'] != ' ')
        echo "<script>alert('$matriculaErr');</script>";

        echo '<html><head><meta http-equiv="Refresh" content="1;cadastro.php"></head></html';
	}	



	function validating_posts($post_name,&$erros)
	{
			$key = $post_name."Err";
			
				if($post_name == 'email' || $post_name == 'matricula')
				{
					$user_choice = $_POST[$post_name];
					define_validator($post_name, $user_choice, $erros, $key);
				}	
	}

	function define_validator($post_name, $user_choice , &$erros, $key)
	{
		switch($post_name)
		{

			case 'email': validating_email($user_choice, $erros, $key);
				break;

			case 'matricula': validating_matricula($user_choice, $erros, $key);
				break;
		}
	}


	function check_on_database($db_column_value,$db_column_name)//bool
	{

		 $db = Database::connect();
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 
		 $query = "select {$db_column_name} from Users where {$db_column_name} = '{$db_column_value}'";
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


	function validating_email($email,&$erros,$key)
	{
		$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");

 		if(check_on_database($email, $db_colluns[4]))
 		$erros[$key] = "Email already registered!";

	}

	function validating_matricula($matricula, &$erros, $key)
	{
		$db_colluns = array("Userid","Curso","Nome","Matricula","Email" ,"Senha", "Nascimento","Genero");

		if(check_on_database($matricula, $db_colluns[3]))
		$erros[$key] = "Matricula already registered!";

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

