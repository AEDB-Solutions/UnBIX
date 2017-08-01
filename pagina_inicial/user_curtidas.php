<?php

session_start();

include("database.php");
include("class_database_query.php");


//print_r(logged_user_curtidas());
echo json_encode(logged_user_curtidas());

function logged_user_curtidas()
{
	$user_id = $_SESSION['id'];

	$find_rows = new db_query();
	$find_rows->set_find_rows("SELECT IDcomplaint,Value FROM Session where  UserID  = $user_id;",array(""));
	$rows = $find_rows->get_db_rows();

	return $rows;
}

?>