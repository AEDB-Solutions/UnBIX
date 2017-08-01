<?php

include("database.php");
include("class_database_query.php");

function picking_loc_one()
{
	$find_rows = new db_query();
	$find_rows->set_find_rows("SELECT * FROM Localidades where keypoint = 1;",array(""));
	$rows = $find_rows->get_db_rows();

	return $rows;
}

function picking_loc_zero()
{
	$find_rows = new db_query();
	$find_rows->set_find_rows("SELECT Complaints.ComplaintID,Complaints.LocalID,Complaints.IDuser,Complaints.Likes,Complaints.Dislikes, Complaints.Titulo, Complaints.Descricao, Complaints.Categoria, Complaints.Emergencia, Localidades.descricao, Localidades.latitude, Localidades.longitude, Localidades.keypoint FROM Complaints INNER JOIN Localidades ON Complaints.LocalID = Localidades.localID",array(""));
	$rows = $find_rows->get_db_rows();

	return $rows;
}

?>

