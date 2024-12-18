
<?php
require_once "seguridad.php";

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
        <link rel="icon" href="img/logo.ico">


     <title>Pagina Principal</title>
     <body>

<!-- menu izquierdo -->
<?php include "menu_izquierdo.php"; ?>

<!-- contenido -->
<div class="cuerpo">
<div class="intro">
            <h2>Acerca del Proyecto</h2>
            <p>
                Este proyecto está diseñado para gestionar reservas de salones.
                Permite a los usuarios organizar horarios, verificar disponibilidad y realizar reservas fácilmente.
            </p>
            <p>
                Funcionalidades principales:
                <ul>
                    <li>Gestión de usuarios</li>
                    <li>Calendario interactivo</li>
                    <li>Seguimiento del estado de las reservas</li>
                </ul>
            </p>
        </div>

        <div class="highlight">
            <h2>¿Por qué usar este sistema?</h2>
            <p>
                Nuestro sistema está optimizado para ahorrar tiempo y reducir errores en la planificación.
                Con una interfaz intuitiva, facilita la administración de recursos de manera eficiente.
            </p>
        </div>
    </div>

    <div id="rodape">
        <p>© 2024 Equipo 5 - Todos los derechos reservados</p>
    </div>


</div>

</body>
</html>