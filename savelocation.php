<?php

    require 'database.php';
   // var_dump($_POST); exit;
 
    if ( !empty($_POST)) 
    {
         
        $id_user = 1;
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $reclam = $_POST['reclam'];
        $adicional = $_POST['adic'];
        $categ = $_POST['categ'];
        $titulo = $_POST['titulo'];

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $q = $pdo->prepare("INSERT INTO Complaints (IDuser, Titulo, Descriçao, Descriçao_adicional, Latitude, Longitude, Categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $q->bindParam(1, $id_user);
            $q->bindParam(2, $titulo);
            $q->bindParam(3, $reclam);
            $q->bindParam(4, $adicional);
            $q->bindParam(5, $lat);
            $q->bindParam(6, $long);
            $q->bindParam(7, $categ);


            //$sql = "INSERT INTO Complaints (IDuser, Titulo, Descriçao, Descriçao_adicional, Latitude, Longitude, Categoria) values (?, ?, ?, ?, ?, ?, ?);"; 
            //$q = $pdo->prepare($sql);
            //$c = array($id_user, $titulo, $reclam, $adicional, $lat, $long, $categ);
            $q->execute();
            //$q->debugDumpParams();
            Database::disconnect();
    }
    
?>
