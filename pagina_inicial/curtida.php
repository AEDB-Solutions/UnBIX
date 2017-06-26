<?php

include("database.php");
include("class_database_query.php");


echo json_encode(pick_number_of_likes('Likes',$_GET['complaint_id'])) . "ola bitvh";
//var_dump(pick_number_of_likes('Likes',10));

//session_user"--"complaint_id"
//update_curtida();

function pick_number_of_likes($db_collun,$complaint_id)
{

	
    $find_row = new db_query();
    $find_row->set_find_row("select $db_collun from Complaints where ComplaintID = $complaint_id",array(""));
    $row = $find_row->get_row();

    //$row[$db_collun];
     $likes = $row[$db_collun];



    //echo "fuck" . $likes . "putas";

    if((int) $likes != 0)
    return (int)$likes;
	
    else
    return 0;
}
/*
function update_curtida()
{
	$session_user = $_GET['session_user'];
    $complaint_id = $_GET['complaint_id'];

    if($_GET['like'] == 1)
    {
    	$update_curtida = pick_number_of_likes('Likes',$complaint_id)+1;
		curtida_insertions('Likes',$update_curtida,$session_user,$complaint_id);	
	}
	
	else
	{
		$update_curtida = pick_number_of_likes('Dislikes',$complaint_id)+1;
		curtida_insertions('Dislikes',$update_curtida,$session_user,$complaint_id);
	}
}


function curtida_insertions($type,$updated_curtida,$session_user,$complaint_id)
{
	insert_into_Complaints_like($type,$updated_curtida,$complaint_id);
	insert_into_session_like($session_user,$complaint_id);
}

function insert_into_session_like($session_user,$complaint_id)
{
	$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    $sql = "INSERT INTO Session (UserID,IDcomplaint) values(?, ?)";    
    $q = $pdo->prepare($sql);
    $a = array($session_user,$complaint_id);
    $q->execute($a);
    Database::disconnect();
}

function insert_into_Complaints_like($type,$updated_curtida,$complaint_id)
{
	$pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    $sql = "UPDATE Complaints SET $type = ? WHERE ComplaintID = ?";    
    $q = $pdo->prepare($sql);
    $a = array($updated_curtida,$complaint_id);
    $q->execute($a);

    Database::disconnect();
}
*/
?>