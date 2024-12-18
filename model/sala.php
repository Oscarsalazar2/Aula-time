<?php
require_once "db_mysqli.php";

class sala
{
 
	function listar()
	{
		
		$db = new Database();
		
		$sql = ' select * from sala order by nombre;' ;
		return $db->query($sql);
	}
	
	function abrir($id)
	{
		
		$db = new Database();
		
		$sql = ' select * from sala where id = '. $id; ;
		return $db->query($sql);
	}
	
	function guardar($id,$nombre)
	{
	
		$db = new Database();
		
		// insertar
		if($id == 0)
		{
			$sql = 'insert into sala ( nombre ) values ("'.$nombre.'")';
			return $db->query_insert($sql);
		}
		else
		{ 
			// actualizar
			$sql = ' update sala set nombre = "'.$nombre.'" where id = ' .$id;
			return $db->query_update($sql);

		}

	}
	
	function eliminar($id)
	{
		$db = new Database();
		$sql = 'delete from sala where id = '.$id; 
		return $db->query_update($sql);
	}
	
	function total()
	{
		$db = new Database();
		$sql = 'select count(id) as total from sala  ';
		return $db->query($sql);
		
	}
	
}

?>