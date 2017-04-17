<?php

include("validating_register_info.php");

	$erros = array('nomeErr' => ' ', 'emailErr' => ' ', 'matriculaErr' => ' ','senhaErr' => ' ', 'confsenhaErr' => ' ', 'cursoErr' => ' ', 'generoErr' => ' ');
	$posts_names= array('nome','email','matricula','senha', 'confsenha', 'curso','genero');

	for($i = 0; $i < count($posts_names); $i++)
	validating_posts($posts_names[$i], $erros);

	if(no_erro($erros))
	{

		 $nome = $_POST['nome'];$curso = $_POST['curso'];$email = $_POST['email'];$matricula = $_POST['matricula'];$genero = $_POST['genero'];$senha = $_POST['senha'];

	        $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Users (Nome,Curso,Email,Matricula,Genero,Senha) values(?, ?, ?, ?, ?, ?);";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$curso,$email,$matricula,$genero,$senha));
            Database::disconnect();
	}

	else
	{	
		foreach($erros as $value)
		echo $value."\n";
	}
	
?>
