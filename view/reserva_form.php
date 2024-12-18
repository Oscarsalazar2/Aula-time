<?php

require_once "seguridad.php";
verificarRol('admin'); 
require_once '../controller/reservaController.php';
$reserva = new ReservaController();

// Guardar dados
$reserva->guardarController();

if(isset($_GET['id']) && is_numeric($_GET['id']))
{
	
	$reg_id = $_GET['id'];
	$sala_id = $_GET['sala_id'];
	$periodo_id = $_GET['periodo_id'];
	
	if( $reg_id  > 0  )
	{
		$row = $reserva->abrirController($reg_id );
		extract($row[0]);
	}
	else
	{
		$status = 1; // reservado	
	
		// sugerir la fecha actual del calendario
		if(isset($_GET['data']))
			$hoy =  date_create_from_format('d/m/Y',$_GET['data']);
		else
			$hoy = new DateTime();
	
		$dia = $hoy->format("d/m/Y");
		$Profesor_alumno ='';
		$materia = '';
		$observacion = '';
		$periodo= '';
		$sala = '';

	}

//1 reservada, 2 confirmada, 3 cancelada 
$a_options_status = array("Reservado", "Confirmado","Cancelado");
$val = 1;
$options_status = '';

foreach($a_options_status as $opt_stat)
{
	if($status == $val)$selected = ' selected="selected" '; else $selected= '';
	$options_status .= "<option value=\"$val\" $selected>$opt_stat</option>";
	$val++;
}


?>
<form name="frm_reserva" id="frm_reserva" onsubmit="return gurardarFormularioReserva()">

<h3> Reservar Salon</h3>

<input type="hidden" name="id" value="<?= $reg_id ?>" />
<input type="hidden" name="sala" value="<?= $sala ?>" />
<input type="hidden" name="periodo" value="<?= $periodo ?>" />
<input type="hidden" name="sala_id" value="<?= $sala_id ?>" />
<input type="hidden" name="periodo_id" value="<?= $periodo_id ?>" />


<input type="text" placeholder="dia" name="dia" id="dia" value="<?= $dia ?>"><BR>

<input type="text" placeholder="Profesor o Alumno" name="profesor" id="profesor" value="<?= $Profesor_alumno ?>" ><BR>

<input type="text" placeholder="Materia o Asunto" name="materia" id="materia" value="<?= $materia ?>"><BR>

<input type="text" placeholder="Observación" name="observacion" id="observacion" value="<?= $observacion ?>" ><BR>

<select name="status" id="status" ><?= $options_status; ?></select><BR>

<h3> Repetir semanalmente hasta</h3>
<input type="text" placeholder="Fecha Final" name="data_final" id="data_final" value=""><BR>

<input type="button" name="Regresar" value="Regresar" onClick="fecharForm()" class="btn1">
<input type="button" name="eliminar" value="Eliminar" class="btn1" onclick="eliminarFormularioReserva(<?= $reg_id ?>)">
<input type="submit" name="guardar" value="Guardar" class="btn2">
</form>
<?php

}

?>