<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
         
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $reclam = $_POST['reclam'];

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Complaints (Latitude, Longitude, Descrição) values(?, ?, ?);"; 
            $q = $pdo->prepare($sql);
            $q->execute($location);
            Database::disconnect();
        }
    
?>
