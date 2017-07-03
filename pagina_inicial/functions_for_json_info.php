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

/*function picking_complaints()
{
	$find_rows = new db_query();
	$find_rows->set_find_rows("SELECT ComplaintID,IDuser,LocalID,Titulo,Descricao,Categoria,Emergencia FROM Complaints;",array(""));
	$rows = $find_rows->get_db_rows();

	return $rows;
}*/


function getting_form_info()
{
	$rows = picking_loc_zero();

	for($i = 0; $i < count($rows); $i++)
	{
	//var_dump($rows[$i]["localID"]);
		$find_row = new db_query();
		$find_row->set_find_row("SELECT ComplaintID,IDuser,Titulo,Categoria,Emergencia,Descricao,Likes FROM Complaints WHERE LocalID = ?;",array($rows[$i]["localID"]));
		$row_complain = $find_row->get_row();


		foreach($row_complain as $key => $value)
		$rows[$i][$key] = $value;
	
		//$rows[$i] = $row_complain;
	}

	//var_dump($rows);	
	return $rows;
}

?>

