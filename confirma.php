	
<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
         
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
        }
    
?>

<html>
<p style=" text-align:center;">
Registro incluído com sucesso!
</p>

 <a href="index.php"> Voltar << </a> 
</html>
