<?php

include("database.php");

var_dump(get_coords()); 

function get_categ() // TESTADA E FUNCIONANDO
{			
		//if (!empty($_POST)) 
        //{ 

         
            //$id_user = $_SESSION['id']; - pensar caso a reclamação seja dele ou não 
            //$categ = $_POST['categ'];
            $categ = 'Infraestrutura'; 
			
			$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "SELECT * FROM Complaints WHERE Categoria = ?;";
            $q = $pdo->prepare($sql);
            $q->execute(array($categ));
            $result = $q->fetchAll();
            //var_dump($q); exit;
            Database::disconnect();

            return $result; //retorna as informações de TODAS AS RECLAMAÇÕES e seus localid
        //}
        //else 
        //{ 
       	//return 0;  
        //}

}

function get_coords()
{
    //montar um while para cada posição do array procurar seu local id e botar tudo no mesmo array 
   		$compl = get_categ();
        $localid = array_column($compl,'LocalID'); 

        //egar tamanho do localid, procurar posição por posição do localid no localidades, e criar array para cada um e colocar todos em um array geral. 
 
        //var_dump($localid); exit; 
        //$i = 0; 
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
          // array_push($all, $result);  //ESSA FUNÇÃO TA APAGANDO TUDO E SUBSTITUINDO, PRECISO QUE ACUMULE
            //var_dump($q); exit;
            Database::disconnect();
           // $i = $i + 1;             
        }

        return $all;

}

function info_marker()
{
			$reclm = get_categ();
			//$coords = get_coords(); 

           // var_dump($reclm); 
           // var_dump($coords);

			//$localid = $reclm["LocalID"]; 
     		$titulo = $reclm["Titulo"];
     		$desc = $reclm["Descricao"];
     		$catego = $reclm["Categoria"];
     		$emerg = $reclm["Emergencia"];
     		$curti = $reclm["Curtida"];  

     		//$local = $coords["descricao"]; 
     		//$lat = $coords["latitude"];
     		//$long = $coords["longitude"];  	

//gerar marker com essas informações - COMO PASSAR VARIAVEL DO PHP PARA HTML (echo???)


}

?>