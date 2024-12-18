<?php

require "util.php";
require "../model/periodo.php";
require "../model/sala.php";
require "../model/reserva.php";

class dashboardController{
	
	// función que genera el encabezado
	function generarEncabezadoController()
	{	
	
		$periodo = new Periodo();
	
		// poner el encabezado
		$tabla_encabezado = '<tr> <th></th> ';
		
		$periodos = $periodo->listar();
		
		foreach($periodos as $periodo)
		{	
			$tabla_encabezado .= ' <th>' . $periodo['nombre'] . '</th>';
		}
		$tabla_encabezado .= '</tr>';

	return $tabla_encabezado;
	
	}
	
	// generar cuerpo
	function generarCuerpoController($hoy)
	{	
	
		
	$sl = new sala();
	$per = new Periodo();
	$res = new Reserva();

	$tabla_cuerpo = '';

	$salas =  $sl->listar();

	// para cada sala
	foreach($salas as $sala)
	{
		$tabla_cuerpo .=' <tr><td> '. $sala['nombre'] . '</td> ';

		// para cada periodo
		$periodos = $per->listar();
		
		foreach($periodos as $periodo)
		{	
		
			$materia_reserva = '';
			$profesores_reserva = '';
	
			// comprobar si este periodo, en esta sala, ese día, está ocupado.
			
			$status = $res->verificarCompleto($hoy,$sala['id'],$periodo['id']);
			
			if(isset($status[0]['id'] ))
			{ 
				if( $status[0]['status'] == 1)
				$css_ocupado = 'reservado' ;
	
				else if ( $status[0]['status'] == 2)
				$css_ocupado = 'confirmado' ;
	
				else if ( $status[0]['status'] == 3)
				$css_ocupado = 'cancelado' ;
		
				$materia_reserva =  $status[0]['materia']  ;
				$profesores_reserva = $status[0]['Profesor_alumno']  ; 
				$id_reserva = $status[0]['id']  ;
				// buscar materias y profesores de esta reserva
	
			}		
			else
			{ 
				$id_reserva = 0;
				$css_ocupado = 'disponible' ;
			}		
			
			// if($materia_reserva =! '') $materia_reserva = '<p>' . $materia_reserva . '</p>';
			
			$tabla_cuerpo .='<td onClick="abreReserva(this)" class="'.$css_ocupado.'" id="'.$id_reserva.'" sala="'.$sala['id'].'" periodo="'.$periodo['id'].'" > '.$materia_reserva. '&nbsp;<hr>&nbsp;'. $profesores_reserva.' </td>';
		
		}

		$tabla_cuerpo .=' </tr>';		
	}

return $tabla_cuerpo;
}


	// informe de Materias con más reservas

	function materiaMasReservasController()
	{
		$res = new Reserva();
	
		$row1 = $res->materiaMasReservas();
	
		$tabla = '';
		foreach($row1 as $row)
		{
			$tabla .= '<tr>
			<td></td>
			<td width="300">'.$row['materia'].' </td>
			<td>'.$row['total'].' </td>
			
				</tr>';
		}
	
	return $tabla ;	
	}
	
	
	function totalHorariosController()
	{
		
		$total_horarios = 0;
		
		$sala = new sala();
		$periodo = new Periodo();
			
		
		// Total de salas * total de horarios * 30 dias
		$salas = $sala->total();
		$periodos = $periodo->total();
		
		$total_horarios = $salas[0]['total']  *  $periodos[0]['total'] * 30  ;
		return $total_horarios;

	}
	
	
	function totalReservasController()
	{
		$reserva = new Reserva();
		
		$hoy = new DateTime();
		
		$reservas = $reserva->totalReservasMes($hoy);
		
		$total_reservas = $reservas[0]['total'];
		
		return $total_reservas;

	}
	
}

?>