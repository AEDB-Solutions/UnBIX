<?php

include("database.php");

//var_dump(get_reclam());

function get_reclam() // TESTADA E FUNCIONANDO -- função que pega a categoria e busca no banco todas as reclamações daquela categoria e junta em um array multidimensional todas as informações, inclusive as que estao no localidaddes;
{
        if (!empty($_GET)) 
        { 

            //$id_user = $_SESSION['id']; - pensar caso a reclamação seja dele ou não 
            $categ = $_GET['categ_'];


            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "SELECT Complaints.LocalID, Complaints.Titulo, Complaints.Descricao, Complaints.Categoria, Complaints.Emergencia, Localidades.descricao, Localidades.latitude, Localidades.longitude FROM Complaints INNER JOIN Localidades ON Complaints.Categoria = ? AND Complaints.LocalID=Localidades.localID;";
            $q = $pdo->prepare($sql);
            $q->execute(array($categ));  
            $result = $q->fetchAll();
            //var_dump($result);exit;
            Database::disconnect();   

            return $result;  
        }      
        else
        {
            return 0;
        }
}

?>