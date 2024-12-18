<?php

require "util.php";
require "../model/sala.php";

class salaController
{
	
	function guardar()
	{
		if(isset($_POST['guardar']))
		{
			$nombre = Util::clearparam($_POST['nombre']);
			$id = Util::clearparam($_POST['id']);

			$sala = new sala();
			$sala->guardar($id,$nombre);
			header("Location: sala_list.php");
			exit();
		}
	}
	
	function eliminar()
	{
		
		if(isset($_POST['eliminar']))
		{
			$id = Util::clearparam($_POST['id']);
			
			$sala = new sala();
			$sala->eliminar($id);
		
			header("Location: sala_list.php");
			exit();
				
		}
		
	}
	
	function abrir()
	{
		
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$sala = new sala();
			return $sala->abrir( $_GET['id']);
		}	
	}
	
	// listar
	function listarcontroller()
	{
		
		$sala = new sala();
		
		$lineas = $sala->listar();
		
		$tabla = '';
		foreach($lineas as $linea)
		{
			$tabla .= '<tr>
							<td>'.$linea['id'].'</td>
							<td><a href="sala_form.php?id='.$linea['id'].'">'.$linea['nombre'].'</a></td>
						</tr>		
							';
		}
		
		return $tabla;
		
	}
}

?>