<?php

include("database.php");

var_dump(get_categ()); 

function get_categ() // TESTADA E FUNCIONANDO -- função que pega a categoria e busca no banco todas as reclamações daquela categoria
{			
		if (!empty($_POST)) 
        { 

         
            //$id_user = $_SESSION['id']; - pensar caso a reclamação seja dele ou não 
            $categ = $_POST['categ'];
			
			$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "SELECT * FROM Complaints WHERE Categoria = ?;";
            $q = $pdo->prepare($sql);
            $q->execute(array($categ));
            $result = $q->fetchAll();
            //var_dump($q); exit;
            Database::disconnect();

            return $result; //retorna TODAS as informações de TODAS AS RECLAMAÇÕES DAQUELA CATEGORIA
        }
        else 
        { 
       	return 0;  
        }

}

function get_coords() //TESTADA E FUNCIONANDO -- função que pega posição a posição do get_categ e procura seu respectivo na localidades, e armazena na mesma posição em outro array
{
   		$compl = get_categ();
        $localid = array_column($compl,'LocalID'); 
        //var_dump($localid); exit;
        $size = count($localid);
        //var_dump($size); exit; 
        $all = NULL;

        for($i = 0; $i < $size; $i++)
        {
            $one = $localid[$i]; 
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "SELECT * FROM Localidades WHERE localID = $one;";
            $q = $pdo->prepare($sql);
            $q->execute();
            //var_dump(array($one)); exit;
            $result = $q->fetchAll();
            //var_dump($result); exit;
            $all[$i] = $result; 
            //var_dump($q); exit;
            Database::disconnect();       
        }

        return $all; // retorna as informações de LOCALIZAÇÃO de TODOS AS RECLAMAÇÕES 

}

function info_marker() 
{
			$reclm = get_categ();
			$coords = get_coords(); 

           // var_dump($reclm); 
           // var_dump($coords);
        // COLOCAR AQUI O QUE DEVE SER RETORNADO PARA O JAVASCRIPT GERAR MARKER
}

?>
