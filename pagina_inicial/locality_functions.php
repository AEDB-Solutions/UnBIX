<?php

include("database.php");
include("class_database_query.php");


function save_content_of_complain()
{
    if(isset($_POST['complaint_id']))
    atualiza_info_on_db();

    else
    save_info_on_db();

}


function save_info_on_db()
{
    $lat = $_POST['lat'];
    $long = $_POST['long'];
    $desc_loc = $_POST['descricao_loc'];
    
    insert_location($lat,$long,$desc_loc);
    insert_into_complaints($lat,$long);

}

function atualiza_info_on_db()
{
    if (!empty($_POST)) 
    {
         
            $id_user = $_SESSION['id'];
            $id_complaint = $_POST['complaint_id'];
            $localID = get_local_id_by_comp_id($id_complaint);
            $titulo = $_POST['Titulo'];
            $desc_comp = $_POST['descricao_comp'];
            $desc_loc = $_POST['descricao_loc'];
            $cat = $_POST['Categoria'];
            $eme = $_POST['Emergencia'];
            //$cur = $_POST['Curtida'];
           
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $sql = "UPDATE Complaints SET IDuser = ?, Titulo = ?, Descricao = ?,Categoria = ?, Emergencia = ? WHERE ComplaintID = ?";
            $q = $pdo->prepare($sql);
            $a = array($id_user, $titulo, $desc_comp, $cat, $eme, $id_complaint);
            $q->execute($a);

            $sql2 = "UPDATE Localidades SET descricao = ? WHERE LocalID = ?";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($desc_loc,$localID));


            Database::disconnect();
    }

}

function insert_location($lat,$long,$desc_loc)
{
    $key_point = 0;

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $query = "INSERT INTO Localidades (latitude,longitude,descricao,keypoint) values(?,?,?,?);";
            $prepare = $pdo->prepare($query);
            $prepare->execute(array($lat,$long,$desc_loc,$key_point));
            Database::disconnect();
}



function insert_into_complaints($lat,$long)
{
        if (!empty($_POST)) 
        {
         
            $id_user = $_SESSION['id'];
            $localID = get_local_id($lat,$long);
            $titulo = $_POST['Titulo'];
            $desc = $_POST['descricao_comp'];
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

function get_local_id_by_comp_id($complaint_id)
{   
    $find_row = new db_query();
    $find_row->set_find_row("select localID from Complaints where ComplaintID = ?",array($complaint_id));
    $row = $find_row->get_row();

    $localid = $row["localID"];

    return $localid;
}

?>
