<?php

include("database.php");
include("class_database_query.php");


function save_info_on_db()
{
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    
    insert_location($lat,$long);
    insert_into_complaints($lat,$long);

}

function atualiza_info_on_db()
{
    if (!empty($_POST)) 
        {
         
            $id_user = $_SESSION['id'];
            $localID = get_local_id($_POST['lat'],$_POST['long']);
            $id_complaint = $_POST['id'];
            $titulo = $_POST['Titulo'];
            $desc = $_POST['Descricao'];
            $cat = $_POST['Categoria'];
            $eme = $_POST['Emergencia'];
            //$cur = $_POST['Curtida'];
           
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "UPDATE Complaints SET IDuser = ?, Titulo = ?, Descricao = ?, Categoria = ?, Emergencia = ? WHERE ComplaintId = ?";
            $q = $pdo->prepare($sql);
            $a = array($id_user, $titulo, $desc, $cat, $eme, $id_complaint);
            //var_dump($pdo);
            $q->execute($a);
            //var_dump($q); exit;
            Database::disconnect();
        }
}

function insert_location($lat,$long)
{
    $key_point = 0;
    $desc = $_POST['Descricao'];


            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $query = "INSERT INTO Localidades (latitude,longitude,descricao,keypoint) values(?,?,?,?);";
            $prepare = $pdo->prepare($query);
            $prepare->execute(array($lat,$long,$desc,$key_point));
            Database::disconnect();
}



function insert_into_complaints($lat,$long)
{
        if (!empty($_POST)) 
        {
         
            $id_user = $_SESSION['id'];
            $localID = get_local_id($lat,$long);
            $titulo = $_POST['Titulo'];
            $desc = $_POST['Descricao'];
            $cat = $_POST['Categoria'];
            $eme = $_POST['Emergencia'];
            //$cur = $_POST['Curtida'];
           
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "INSERT INTO Complaints (IDuser, LocalID, Titulo, Descricao, Categoria, Emergencia) values(?, ?, ?, ?, ?, ?);";
            $q = $pdo->prepare($sql);
            $a = array($id_user, $localID, $titulo, $desc, $cat, $eme);
            //var_dump($pdo);
            $q->execute($a);
            //var_dump($q); exit;
            Database::disconnect();
        }

}

function get_local_id($lat,$long)
{
    $find_row = new db_query();
    $find_row->set_find_row("select localID from Localidades where latitude = ? and longitude = ?",array($lat,$long));
    $row = $find_row->get_row();

     $localid = $row["localID"];

    return $localid;
}

?>