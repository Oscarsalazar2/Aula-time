<?php
require_once "db_mysqli.php";

class Usuario
{
    // Función para autenticar usuario con rol
    function autenticar($n_control, $contraseña)
    {
        $db = new Database();

        // Consulta para obtener id y rol del usuario
        $sql = 'SELECT id, rol FROM usuario 
                WHERE n_control = "' . $n_control . '" 
                AND contraseña = "' . $contraseña . '";';
        return $db->query($sql); // Retorna el resultado
    }

    // Función para listar usuarios con sus roles
    function listar()
    {
        $db = new Database();

        // Consulta para obtener todos los usuarios con sus roles
        $sql = 'SELECT id, nombre, n_control, rol 
                FROM usuario 
                ORDER BY nombre;';
        return $db->query($sql);
    }

    // Función para abrir detalles de un usuario
    function abrir($id)
    {
        $db = new Database();

        // Consulta para obtener un usuario por su id
        $sql = 'SELECT id, nombre, n_control, rol 
                FROM usuario 
                WHERE id = ' . $id . ';';
        return $db->query($sql);
    }

    // Función para guardar (insertar o actualizar) un usuario con su rol
    function guardar($id, $nombre, $n_control, $contraseña, $rol)
    {
        $db = new Database();

        // Insertar un nuevo usuario
        if ($id == 0) {
            $contraseña = md5($contraseña); // Encriptar la contraseña
            $sql = 'INSERT INTO usuario (nombre, n_control, contraseña, rol) 
                    VALUES ("' . $nombre . '", "' . $n_control . '", "' . $contraseña . '", "' . $rol . '")';
            return $db->query_insert($sql);
        } else { 
            // Actualizar un usuario existente
            if (!empty($contraseña)) {
                $contraseña = ' , contraseña = md5("' . $contraseña . '")';
            } else {
                $contraseña = '';
            }

            $sql = 'UPDATE usuario 
                    SET nombre = "' . $nombre . '", 
                        n_control = "' . $n_control . '", 
                        rol = "' . $rol . '" ' 
                        . $contraseña . ' 
                    WHERE id = ' . $id;
            return $db->query_update($sql);
        }
    }

    // Función para eliminar un usuario
    function eliminar($id)
    {
        $db = new Database();
        $sql = 'DELETE FROM usuario WHERE id = ' . $id . ';';
        return $db->query_update($sql);
    }
}


?>