<?php
require_once "seguridad.php";
verificarRol('admin'); 
require_once "../controller/usuarioController.php";

$usuarioController = new UsuarioController();

$usuario = $usuarioController->eliminar();
$usuario = $usuarioController->guardar();
$usuario = $usuarioController->abrir();

if (isset($usuario[0])) {
    extract($usuario[0]);
}

if (!isset($id)) {
    $nombre = '';
    $n_control = '';
    $contraseña = '';
    $rol = '';
    $id = 0;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script src="js/jquery.js"></script>
    <script src="js/jquery.datetimepicker.full.js"></script>
    <script src="js/dateformat.js"></script>

    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
    <link rel="icon" href="img/logo.ico">


    <script src="js/lib.js"></script>
</head>
<title>Registro de Usuario</title>

<body>

    <!-- menú izquierdo -->
    <?php include "menu_izquierdo.php"; ?>

    <!-- contenido -->

    <div class="cuerpo">

        <h3> Registro de Usuario </h3>

        <form name="form1" method="post" target="_self">

            <input type="hidden" name="id" value="<?= $id ?>" />

            <table class="tabla_comum" cellpadding="4" cellspacing="4">

                <tr>
                    <td width="100"> Nombre </td>
                    <td><input type="text" name="nombre" value="<?= $nombre ?>" /> </td>
                    <td width="30"></td>
                    <td width="100"> Num. Control </td>
                    <td> <input type="text" name="n_control" value="<?= $n_control ?>" /></td>
                </tr>

                <tr>
                    <td width="100"> Contraseña </td>
                    <td>
                        <input type="text" id="contraseña" name="contraseña" value="<?= isset($contraseña) ? $contraseña : '' ?>" />
                    </td>
                    <td width="30"></td>
                    <td width="100"> Rol </td>
                    <td><select name="rol">
                            <option value="user" <?= $rol === 'user' ? 'selected' : '' ?>>Usuario</option>
                            <option value="admin" <?= $rol === 'admin' ? 'selected' : '' ?>>Administrador</option>
                        </select></td>
                    <td></td>
                </tr>
                <br>

            </table>

            <input type="submit" name="guardar" value="Guardar" class="btn1" />
            <input type="submit" name="eliminar" value="Eliminar" class="btn1" />

        </form>

    </div>

</body>

</html>