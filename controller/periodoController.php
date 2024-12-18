<?php

require "util.php";
require "../model/periodo.php";

class periodoController
{
	
	function guardar()
	{
		if(isset($_POST['guardar']))
		{
			$nombre = Util::clearparam($_POST['nombre']);
			$id = Util::clearparam($_POST['id']);

			$periodo = new Periodo();
			$periodo->guardar($id,$nombre);
			header("Location: periodo_list.php");
			exit();
		}
	}
	
	function eliminar()
	{
		
		if(isset($_POST['eliminar']))
		{
			$id = Util::clearparam($_POST['id']);
			
			$periodo = new Periodo();
			$periodo->eliminar($id);
		
			header("Location: periodo_list.php");
			exit();
				
		}

	}
	
	function abrir()
	{
		
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$periodo = new Periodo();
			return $periodo->abrir( $_GET['id']);
		}	
		
	}

	// listar
	function listarcontroller()
{
    $periodo = new Periodo();

    // Obtener las líneas del modelo
    $lineas = $periodo->listar();

    $tabla = ''; // Inicializar $tabla como una cadena vacía

    // Verificar si $lineas contiene datos
    if (is_array($lineas)) {
        foreach ($lineas as $linea) {
            $tabla .= '<tr>
                           <td>' . htmlspecialchars($linea['id'], ENT_QUOTES, 'UTF-8') . '</td>
                           <td><a href="periodo_form.php?id=' . htmlspecialchars($linea['id'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($linea['nombre'], ENT_QUOTES, 'UTF-8') . '</a></td>
                       </tr>';
        }
    }

    return $tabla;
}

	
}

?>