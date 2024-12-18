<?php

require "util.php";
require "../model/usuario.php";

class UsuarioController
{
	
	function guardar()
	{
		if(isset($_POST['guardar']))
		{
			$nombre = Util::clearparam($_POST['nombre']);
			$n_control = Util::clearparam($_POST['n_control']);
			$contraseña = Util::clearparam($_POST['contraseña']);
			$id = Util::clearparam($_POST['id']);
			$rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';
			
			// si no has cambiado la contraseña, no la guardes nuevamente ya que está cifrada
			if(strlen($contraseña) == 32)
			{
			$contraseña = '';	
			}
			
			$usuario = new Usuario();
			$usuario->guardar($id,$nombre, $n_control,$contraseña,$rol);
			header("Location: usuario_list.php");
			exit();
		}
	}
	
	function eliminar()
	{
		
		if(isset($_POST['eliminar']))
		{
			$id = Util::clearparam($_POST['id']);
			
			$usuario = new Usuario();
			$usuario->eliminar($id);
		
			header("Location: usuario_list.php");
			exit();
				
		}
	}
	
	function abrir()
	{
		
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			$usuario = new Usuario();
			return $usuario->abrir( $_GET['id']);
		}	
		
	}

	// listado
	function listarcontroller()
	{
		
		$usuario = new Usuario();
		
		$lineas = $usuario->listar();
		
		$tabla = '';
		foreach($lineas as $linea)
		{
			$tabla .= '<tr>
							<td>'.$linea['id'].'</td>
							<td><a href="usuario_form.php?id='.$linea['id'].'">'.$linea['nombre'].'</a></td>
							<td>'.$linea['n_control'].'</td>
							<td>' . $linea['rol'] . '</td>
						</tr>		
							';
			
		}
		
		return $tabla;
		
	}
	
	// función de autenticación de usuario
	function autenticarController()
{
    if (isset($_POST['n_control']) && isset($_POST['contraseña'])) {
        $contraseña = md5($_POST['contraseña']);
        $n_control = Util::clearparam($_POST['n_control']);
        
        $usuario = new Usuario();
        $row = $usuario->autenticar($n_control, $contraseña);
        
        if (isset($row[0]['id'])) {
            session_start();
            $_SESSION['user_id'] = $row[0]['id'];
            $_SESSION['user_rol'] = $row[0]['rol']; // Almacena el rol en la sesión
            header("Location: index.php"); // Redirige al inicio
            exit();
        } else {
            return "Número de Control o contraseña inválidos";
        }
    } else {
        return ''; // Nada que hacer
    }
}

}

?>