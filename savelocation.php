<?php
     
    require 'database.php';
    var_dump($_POST); exit;
 
    if ( !empty($_POST)) 
    {
         
        $lat = $_POST['lat'];
        $long = $_POST['long'];
        $reclam = $_POST['reclam'];
        $adicional = $_POST['adic'];
        $categ = $_POST['categ'];
        $titulo = $_POST['titulo'];




            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Complaints (IDuser, Titulo, Descriçao, Descriçao_adicional, Latitude, Longitude, Categoria) values (1, $titulo, $reclam, $adicional, $lat, $long, $categ);"; //O IDuser é temporario para testes enquanto nao temos sessão. 
            $q = $pdo->prepare($sql);
            $q->execute(array($lat, $long, $reclam, $categ, $titulo));
            Database::disconnect();
        }
    
?>
