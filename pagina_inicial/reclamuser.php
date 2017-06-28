<?php

session_start();

if(empty($_SESSION['id'])) {
    header("location:../index.php"); 
}

include("database.php");

echo json_encode(get_user_reclam());

//var_dump(get_user_reclam());

function get_user_reclam() // TESTADA E FUNCIONANDO 
{

            $id_user = $_SESSION['id'];
            //$id_user = '1'; 

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "SELECT Complaints.LocalID, Complaints.Titulo, Complaints.Descricao, Complaints.Categoria, Complaints.Emergencia, Localidades.descricao, Localidades.latitude, Localidades.longitude, Localidades.keypoint FROM Complaints INNER JOIN Localidades ON Complaints.IDuser = ? AND Complaints.LocalID=Localidades.localID;";
            $q = $pdo->prepare($sql);
            $q->execute(array($id_user));  
            //var_dump($q);exit;
            $result = $q->fetchAll();
            //var_dump($result);exit;
            Database::disconnect();   

            return $result;  
}


?>