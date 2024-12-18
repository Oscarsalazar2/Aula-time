<?php

require_once "seguridad.php";
require_once("../controller/dashboardController.php");

$dsc = new dashboardController();

if (isset($_GET['data'])) {
	$hoy =  date_create_from_format('d/m/Y', $_GET['data']);
} else {
	$hoy = new DateTime();
}


// generar encabezado
$tabla_Encabezado = $dsc->generarEncabezadoController();

// generar cuerpo
$tabla_cuerpo = $dsc->generarCuerpoController($hoy);

// configurar dias
$dia_anterior = date_create_from_format('d/m/Y', $hoy->format("d/m/Y"));
$dia_anterior->modify('-1 day');

$dia_posterior  = date_create_from_format('d/m/Y', $hoy->format("d/m/Y"));
$dia_posterior->modify('+1 day');

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
	

	<script src="js/lib.js"></script>
	<script>
		//variable con fecha

		var data = '<?= $hoy->format("d/m/Y"); ?>';
		var dia_anterior = '<?= $dia_anterior->format("d/m/Y"); ?>';
		var dia_posterior = '<?= $dia_posterior->format("d/m/Y"); ?>';
		// configurar el calendario

		jQuery.datetimepicker.setLocale('es');

		// configura el área visible del formulario

		$(window).on('scroll resize load', getVisible);


		$(window).load(function() {
			$('#data').datetimepicker({
				timepicker: false,
				format: 'd/m/Y'
			});

		});


		function actualizarpantalla(o) {
			//obtiene los datos de la fecha actual y actualiza la pantalla
			window.location.href = "index.php?data=" + $(o).val();
		}

		function volverPantalla() {
			window.location.href = "index.php?data=" + dia_anterior;
		}

		function avancePantalla() {
			window.location.href = "index.php?data=" + dia_posterior;
		}
	</script>
	<link rel="icon" href="img/logo.ico" type="image/x-icon">
	<title>Inicio</title>
</head>

<body>

	<!-- form -->
	<div class="form">

	</div>


	<!-- menu izquierdo -->
	<?php include "menu_izquierdo.php"; ?>

	<!-- contenido -->
	<div class="cuerpo">

		<div class="titulo_inicial">

			<img src="img/retroceder.png" width="40" height="40" alt="" onclick="volverPantalla()" />

			<div>
				<form method="get" action="index.php" target="_self" name="form1">
					<input type="text" readonly="readonly" name="data" id="data" value="<?= $hoy->format("d/m/Y"); ?>" onchange="actualizarpantalla(this)" />
				</form>
			</div>

			<img src="img/avanzar.png" width="40" height="40" alt="" onclick="avancePantalla()" />
		</div>

		<table border="0" cellpadding="4" cellspacing="0">

			<thead>

				<?= $tabla_Encabezado ?>

			</thead>

		</table>

		<div class="tabelarow">

			<table border="0" cellpadding="4" cellspacing="0">

				<tbody>

					<?= $tabla_cuerpo ?>

				</tbody>

			</table>

		</div>


	</div>


</body>

</html>