	<?php

//pode ser que precise do database em outro caso;
class db_query
{
	private $db_element;//string;
	private $db_row;//array de string;
	private $db_rows;//array_bidimensional


	public function set_find_row($query,$search_elements)//query que busque exatamente uma coluna;objetivo achar uma linha do banco;
	{
		$db = Database::connect();	
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$prepare = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$prepare->execute($search_elements);

		  while ($row = $prepare->fetch(PDO::FETCH_BOTH, PDO::FETCH_ORI_NEXT))
		  {
		  		$this->db_row = $row;
		  		//break;
		  }

		Database::disconnect();

	}

	public function get_row()
	{
		return $this->db_row;
	}

//----------------------------------------------------------------------------------------------------------------------------


	public function set_find_element($query,$search_elements,$db_collun)//coloque um query que busque no maximo uma coluna;objetivo é achar um elemento
	{
		$db = Database::connect();	
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$prepare = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$prepare->execute($search_elements);

		while($row = $prepare->fetch(PDO::FETCH_BOTH, PDO::FETCH_ORI_NEXT))
		{
			$single_element = $row[$db_collun];
		}

		Database::disconnect();

		$this->db_element = $single_element;

	}

	public function get_element()
	{
		return $this->db_element;
	}


//------------------------------------------------------------------------------------------------------------------------------

	public function set_find_rows($query,$search_elements)//query que busca um varias linhas.Qualquer query serve//o programador pode buscar varias linhas e obter um elemento por manipulação propria;
	{
		$db = Database::connect();	
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$prepare = $db->prepare($query);
		$prepare->execute($search_elements);
		$result = $prepare->fetchAll();
		Database::disconnect();

		$this->db_rows = $result;


	}

	public function get_db_rows()
	{
		return $this->db_rows;
	}

}

?>
