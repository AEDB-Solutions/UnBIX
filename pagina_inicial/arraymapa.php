<?php

include("database.php");

//$lista2 = array("larissa", "giovanna" );
//$lista3 = array("lala", "gigi");
//$lista = array($lista2, $lista3);

var_dump(get_array());

function get_array()
{
        if (!empty($_POST)) 
        { 

            //$id_user = $_SESSION['id']; - pensar caso a reclamação seja dele ou não 
            $categ = $_POST['botao-mapa'];
            var_dump($categ);
            //$categ = "Infraestrutura";


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

//executar a tabela

?>