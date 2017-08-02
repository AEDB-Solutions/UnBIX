<?php

include("database.php");
include("class_database_query.php");

choose_update();
//  echo json_encode(pick_user_complain($_GET['complaint_id'],$_GET['session_user']));

function pick_user_complain($complaint_id,$user_id)
{
     $find_row = new db_query();
    $find_row->set_find_row("select Value from Session WHERE IDcomplaint = ? and UserID = ?;",array($_GET['complaint_id'],$_GET['session_user']));
    $row = $find_row->get_row();
    $value = (int) $row['Value'];
    return $value;
}

function pick_number_of_likes($db_collun,$complaint_id)
{

    $find_row = new db_query();
    $find_row->set_find_row("select $db_collun from Complaints where ComplaintID = $complaint_id",array(""));
    $row = $find_row->get_row();

    //$row[$db_collun];
     $likes = $row[$db_collun];


    if((int) $likes != 0)
    return (int)$likes;
    
    else
    return 0;
}


function choose_update()
{

    if($_GET['option'] == "incrementa")
    curtida_insertions();

    else
    curtida_delete();  

}

function curtida_delete()
{

    $value = pick_user_complain($_GET['complaint_id'],$_GET['session_user']);
    
    if($value == 1)
    {
        delete_curtida('Likes',$_GET['complaint_id'],$_GET['session_user']);
    }

    else
    {
        delete_curtida('Dislikes',$_GET['complaint_id'],$_GET['session_user']);
    }

    //pega no session o valor do complaintID SE LIKE DESLIke
    //decrementar o complaints;
    //depois excluir da session


}

function delete_curtida($delete_collun,$complaint_id,$session_user)
{
    $update_curtida = pick_number_of_likes($delete_collun,$complaint_id)-1;
    insert_into_Complaints_like($delete_collun,$update_curtida,$complaint_id);
    delete_like_session($complaint_id,$session_user);
}

function delete_like_session($complaint_id,$session_user)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    $sql = "delete from Session where IDcomplaint = ? and UserID = ?";    
    $q = $pdo->prepare($sql);
    $q->execute(array($complaint_id,$session_user));
    Database::disconnect();
}

function curtida_insertions()
{
    $session_user = $_GET['session_user'];
    $complaint_id = $_GET['complaint_id'];

    if($_GET['like'] == 1)
    {
        $update_curtida = pick_number_of_likes('Likes',$complaint_id)+1;
        insert_update('Likes',$update_curtida,$session_user,$complaint_id);    
    }
    
    else
    {
        $update_curtida = pick_number_of_likes('Dislikes',$complaint_id)+1;
        insert_update('Dislikes',$update_curtida,$session_user,$complaint_id);
    }
}

function insert_update($db_collun,$updated_curtida,$session_user,$complaint_id)
{
    if($db_collun == 'Likes')
    $value_session = 1;//para likes

    else
    $value_session = 0;//para deslikes

    insert_into_Complaints_like($db_collun,$updated_curtida,$complaint_id);
    insert_into_session_like($session_user,$complaint_id,$value_session);
}

function insert_into_session_like($session_user,$complaint_id,$value_session)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    $sql = "INSERT INTO Session (UserID,IDcomplaint,Value) values(?, ?, ?)";    
    $q = $pdo->prepare($sql);
    //array($session_user,$complaint_id,$,$value_session);
    $q->execute(array($session_user,$complaint_id,$value_session));
    Database::disconnect();
}

function insert_into_Complaints_like($db_collun,$updated_curtida,$complaint_id)
{
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    $sql = "UPDATE Complaints SET $db_collun = ? WHERE ComplaintID = ?";    
    $q = $pdo->prepare($sql);
    $a = array($updated_curtida,$complaint_id);
    $q->execute($a);

    Database::disconnect();
}

?>