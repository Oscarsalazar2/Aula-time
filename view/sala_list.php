﻿<?php

require_once "seguridad.php";
verificarRol('admin'); 

require_once "../controller/salaController.php";

$salaController = new salaController();
$lista = $salaController->listarcontroller();

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

<title>Lista de Salones</title>
<body>

<!-- form -->
<div class="form">

</div>


<!-- menu izquierdo -->
<?php include "menu_izquierdo.php"; ?>

<!-- contenido -->

<div class="cuerpo">

<h3> Lista de Salones </h3>

<input type="button" name="Nuevo" value="Nuevo" class="btn1" onclick="abre('sala_form.php')" />
<br><br>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?= $lista ?>
        </tbody>
    </table>
</div>

</div>
</body>
</html>