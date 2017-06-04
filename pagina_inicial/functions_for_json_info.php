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
	$find_rows->set_find_rows("SELECT * FROM Localidades where keypoint = 0;",array(""));
	$rows = $find_rows->get_db_rows();

	return $rows;
}

function picking_complaints()
{
	$find_rows = new db_query();
	$find_rows->set_find_rows("SELECT IDuser,LocalID,Titulo,Descricao,Categoria,Emergencia FROM Complaints;",array(""));
	$rows = $find_rows->get_db_rows();

	return $rows;
}

?>
