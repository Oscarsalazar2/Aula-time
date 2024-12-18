<?php

require_once "seguridad.php";
require_once '../controller/reservaController.php';

$reserva = new ReservaController();

// Elimina datos
$reserva->eliminarController();

?>