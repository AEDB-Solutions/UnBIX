<?php

    require 'database.php';
   // var_dump($_POST); exit;
 
    if ( !empty($_POST)) 
    {
         
        $id_user = 1;
        $localID = 4;
        $titulo = $_POST['Titulo'];
        $desc = $_POST['Descricao'];
        $cat = $_POST['Categoria'];
        $eme = $_POST['Emergencia'];
        $cur = $_POST['Curtida'];
           
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "INSERT INTO Complaints (IDuser, LocalID, Titulo, Descricao, Categoria, Emergencia, Curtida) values(?, ?, ?, ?, ?, ?, ?);";
            $q = $pdo->prepare($sql);
            $a = array($id_user, $localID, $titulo, $desc, $cat, $eme, $cur);
            //var_dump($pdo);
            $q->execute($a);
            //var_dump($q); exit;
            Database::disconnect();
        }
    
?>
