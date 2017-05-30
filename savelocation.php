<?php

    require 'database.php';
   // var_dump($_POST); exit;
 
    if ( !empty($_POST)) 
    {
         
        $id_user = 1;
        //$lat = $_POST['lat'];
        //$long = $_POST['long'];
        //$reclam = $_POST['reclam'];
        //$adicional = $_POST['adic'];
        //$categ = $_POST['categ'];
        //$titulo = $_POST['titulo'];

        $localID = 4;
        $titulo = 'hsdcjk';
        $desc = 'perto';
        $cat = 'infraestrutura';
        $eme = '1';
        $cur = 10;
           
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
