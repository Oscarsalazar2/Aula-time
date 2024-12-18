<?php
require_once "seguridad.php";
verificarRol('admin'); 
require_once "../controller/salaController.php";

$salaController = new salaController();

$sala = $salaController->eliminar();
$sala = $salaController->guardar();
$sala = $salaController->abrir();
if(isset($sala[0]))
extract($sala[0]);

if(!isset($id))
{
	$nombre = '';
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
        
        <!-- <link href="css/select2.min.css" rel="stylesheet" /> -->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
        <link rel="icon" href="img/logo.ico">

		<!-- <script src="js/select2.min.js"></script> -->
  	 <script src="js/lib.js"></script>
     </head>
     <title>Registro de Salones</title>
     <body>

<!-- menu izquierdo -->
<?php include "menu_izquierdo.php"; ?>

<!-- contenido -->

<div class="cuerpo">

<h3> Registro de Salones </h3>


<form name="form1" method="post" target="_self">

<input type="hidden" name="id" value="<?= $id ?>" />

<table class="tabla_comum" cellpadding="4" cellspacing="4">
    <tr>
        <td width="100"> Nombre </td>
        <td><input type="text" name="nombre" value="<?= $nombre ?>" /> </td>
        <td width="30"></td>
        <td width="100"> </td>
        <td > </td>
    </tr>
</table>

<input type="submit" name="guardar" value="Guardar" class="btn1" />

<input type="submit" name="eliminar" value="Eliminar" class="btn1" />

</form>

</div>

</body>
</html>