<?php
     
    require 'database.php';
    var_dump($_POST); exit;
 
    if ( !empty($_POST)) 
    {
         
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $reclam = $_POST['reclam'];
        $categ = $_POST['categ'];
        $titulo = $_POST['titulo'];



            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Complaints (Latitude, Longitude, Descrição, Categoria, Título) values(?, ?, ?, ?, ?);";
            $q = $pdo->prepare($sql);
            $q->execute(array($lat, $long, $reclam, $categ, $titulo));
            Database::disconnect();
        }
    
?>

