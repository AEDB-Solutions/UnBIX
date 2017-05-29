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
        echo '<html><title>UnBIX | Cadastro Realizado com sucesso!</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-green w3-card-2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Quem somos</a>
    <a href="http://www.unb.br/" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" target="_blank">UnB</a>
  </div> 

  <header class="w3-container w3-light-grey w3-center" style="padding:128px 16px">
  <img src=" http://i.imgur.com/RJTalj1.png" alt="UNBIX - Logo" style="width:auto; height:auto;">
  <p class="w3-xlarge">Cadastro Realizado com sucesso!</p>
  <a href="index.php" class="w3-button w3-green w3-padding-large w3-large w3-margin-top">Voltar</a>
  <!--<button onclick="window.location.href=index.php" class="w3-button w3-green w3-padding-large w3-large w3-margin-top">Voltar</button></br>-->

</header>
<!-- Fazer o Footer funcionar! -->
<!--
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-gears" style="font-size:36px;color:red"></i>
    <i class="fa fa-terminal" style="font-size:36px;color:orange"></i>
    <i class="fa fa-check" style="font-size:36px;color:yellow"></i>
    <i class="fa fa-map-o" style="font-size:36px;color:green"></i>
    <i class="fa fa-thumb-tack" style="font-size:36px;color:blue"></i>
    <i class="fa fa-thumbs-up" style="font-size:36px;color:purple"></i>

 </div>
 <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
-->

</body>
</html>';    
        //echo '<html><p style=" text-align:center;">Registro feito com sucesso!</p><a href="index.php"> Voltar << </a> </html>';

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
