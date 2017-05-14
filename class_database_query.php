<?php

//pode ser que precise do database em outro caso;
class db_query
{
	private $db_element;//string;
	private $db_row;//array de string;
	private $db_rows;//array_bidimensional


	public function set_find_row($colluns_to_search,$db_table,$after_where,$search_elements)//query que busque exatamente uma coluna;objeto achar uma linha do banco;
	{
		$db = Database::connect();	
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "select $colluns_to_search from  $db_table WHERE $after_where;";
		$prepare = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$prepare->execute($search_elements);

		  while ($row = $prepare->fetch(PDO::FETCH_BOTH, PDO::FETCH_ORI_NEXT))
		  {
		  		$this->db_element = $row;
		  		//break;
		  }

		Database::disconnect();

	}

	public function get_row()
	{
		return $this->db_element;
	}

//--------------------------------------------------------------------------------------------------------------------------


	public function set_find_element($query,$search_elements,$db_collun)//coloque um query que busque no maximo uma coluna;objeto é achar um elemento
	{
		$db = Database::connect();	
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$prepare = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$prepare->execute($search_elements);

		while($row = $prepare->fetch(PDO::FETCH_BOTH, PDO::FETCH_ORI_NEXT))
		{
			$sigle_element = $row[$db_collun];
		}

		return $single_element;

	}

	public function get_element()
	{
		return $this->db_element;
	}


//---------------------------------------------------------------------------------------------------------------------------------

	public function set_find_rows()//query que busca um varias linhas do banco de dados;array multi
	{
		//...
	}

	public function get_db_rows()
	{
		return $this->db_rows;
	}

}

?>