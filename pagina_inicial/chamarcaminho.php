<?php

include("pathway.php"); 

            //$id_user = $_SESSION['id']; - pensar caso a reclamação seja dele ou não 
$categ = $_POST['opcao'];
$raio = $_POST['raio'];

//$categ = 'Banheiro F';
//$raio = 500;

echo json_encode(which_categ($categ, $raio)); //nao reconhece pq é uma função js dentro do html 

//e se pegaar a categ pelo post do botao, e fazer um php novo e colocar aqui e fzer a busca de novo e chama aqui ja igual o loc_0

?>
