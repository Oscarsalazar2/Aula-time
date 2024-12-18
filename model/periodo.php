<?php
require_once "db_mysqli.php";

class Periodo
{

	function listar()
	{
		$db = new Database();
		
		$sql = ' select * from periodo order by nombre;' ;
		return $db->query($sql);
	}
	
	function abrir($id)
	{
		
		$db = new Database();
		
		$sql = ' select * from periodo where id = '. $id; ;
		return $db->query($sql);
	}
	
	function guardar($id,$nombre)
	{
	
		$db = new Database();
		
		// insertar
		if($id == 0)
		{
			$sql = 'insert into periodo ( nombre ) values ("'.$nombre.'")';
			return $db->query_insert($sql);
		}
		else
		{ 
			// atualizar
			$sql = ' update periodo set nombre = "'.$nombre.'" where id = ' .$id;
			return $db->query_update($sql);

		}
	}
	
	function eliminar($id)
	{
		$db = new Database();
		$sql = 'delete from periodo where id = '.$id; 
		return $db->query_update($sql);
	}
	
	
	function total()
	{
		$db = new Database();
		$sql = 'select count(id) as total from periodo  ';
		return $db->query($sql);
		
	}
}

?>