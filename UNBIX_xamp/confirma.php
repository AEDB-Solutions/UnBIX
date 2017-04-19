<?php

header("Content-Type: text/html; charset=ISO-8859-1", true);
include("validating_register_info.php");

	$erros = array('nomeErr' => ' ', 'emailErr' => ' ', 'matriculaErr' => ' ','senhaErr' => ' ', 'confsenhaErr' => ' ', 'cursoErr' => ' ', 'generoErr' => ' ');
	$posts_names= array('nome','email','matricula','senha', 'confsenha', 'curso','genero');

	for($i = 0; $i < count($posts_names); $i++)
	validating_posts($posts_names[$i], $erros);

	if(no_erro($erros))
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

	else
	{
		$emailErr = $erros['emailErr'];
		$matriculaErr = $erros['matriculaErr'];
			
		if($erros['emailErr'] != ' ')
		echo "<script>alert('$emailErr');</script>";

		else if($erros['matriculaErr'] != ' ')
		echo "<script>alert('$matriculaErr');</script>";

		echo '<html><head><meta http-equiv="Refresh" content="1;cadastro.php"></head></html';

	}
	
?>
