<?php

session_start();

function verificarRol($rolRequerido) {
    if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== $rolRequerido) {
        echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Acceso Restringido</title>
            <link rel='stylesheet' type='text/css' href='css/estilo.css'> <!-- Incluye tu CSS -->
            <link rel='icon' href='img/logo.ico'>
        </head>
        <body>
            <div class='pagina_error' style='text-align: center; margin-top: 50px;'>
                <h2 class='titulo_error'>Acceso Restringido</h2>
                <p>Esta sección solo está disponible para <strong>administradores</strong>.</p>
                <p>Para reservar envía un correo a example@gmail.com o acude con el encargado del salón. </p>
                <form action='index.php' method='get'>
                    <button type='submit' class='btn3'>Volver al inicio</button>
                </form>
            </div>
        </body>
        </html>
        ";
        exit(); // Detiene la ejecución del script 
    }
}


// Si existe sesion activa va a dejar seguir si no lanza al login
if(!isset($_SESSION['user_id'])){
	header("Location: login.php");
	exit;
}else{
	//si todo está bien con la sesión, agrega config. 
	require_once("config.php");
}

?>