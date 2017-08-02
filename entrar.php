	
<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
         

        $matricula = $_POST['matricula'];
	$senha = $_POST['senha'];

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "Select nome from Users where matricula= $matricula and senha = $senha;";
            $q = $pdo->prepare($sql);
            $q->execute(array($matricula,$senha));
            Database::disconnect();
        }
    
?>

<html>
<p style=" text-align:center;">
<?php

nome = $data['nome'];

if (nome <> "") {
    echo "Login realizado com sucesso:" + nome;
}
else
{ 
    echo "Login incorreto!";
}
?>
</p>
</html>
