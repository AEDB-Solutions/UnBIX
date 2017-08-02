<?php

session_start();

if(empty($_SESSION['id'])) {
    header("location:../index.php"); 
}

include("database.php");

//echo json_encode(get_user());

//var_dump(get_user()));

function get_user() // TESTADA E FUNCIONANDO 
{

            $id_user = $_SESSION['id'];
            //$id_user = '1'; 

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "SELECT Users.Nome, Users.Matricula, Users.Email FROM Users ON Users.Userid = ?;";
            $q = $pdo->prepare($sql);
            $q->execute(array($id_user));  
            //var_dump($q);exit;
            $result = $q->fetchAll();
            //var_dump($result);exit;
            Database::disconnect();   

            return $result;  
}


?>