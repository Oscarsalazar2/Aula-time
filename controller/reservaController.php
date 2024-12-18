<?php

require "../model/reserva.php";
require "util.php";


class ReservaController{
	

	function abrirController($id)
	{
		
		$reserva = new Reserva();
		
		return $reserva->abrir($id);
		
		
	}
	
	function eliminarController()
	{
		if(isset($_POST['id']))
		{	
			// eliminar	
			$id= Util::clearparam($_POST['id']);
			$reserva = new Reserva(); 
			echo $reserva->eliminar($id);
			
		}
	}
	
	function guardarController(){

		// se hizo clic en el botón guardar
		if(isset($_POST['id']))
		{
			
			// recibir datos
			
			$id= Util::clearparam($_POST['id']);
			$dia= Util::clearparam($_POST['dia']);
			$profesor= Util::clearparam($_POST['profesor']);
			$materia= Util::clearparam($_POST['materia']);
			$dia= Util::clearparam($_POST['dia']);
			$observacion = Util::clearparam($_POST['observacion']);
			$status = Util::clearparam($_POST['status']);
			
			$sala= Util::clearparam($_POST['sala']);
			$periodo= Util::clearparam($_POST['periodo']);
			
			$sala_id = Util::clearparam($_POST['sala_id']);
			$periodo_id = Util::clearparam($_POST['periodo_id']);
			
			$data = new DateTime();
			$data = date_create_from_format('d/m/Y',$dia);
			
			$reserva = new Reserva(); 
			
			// comprueba si la fecha no está ocupada para un nuevo registro
			if($id == 0)
			{
				$id_existente = $reserva->verificar($data, $sala_id,$periodo_id);
				if(isset($id_existente['id'])){
					echo "La fecha seleccionada para esta habitación en este periodo ya está ocupada.";
					 return false;
				 }
			}
			
			$id = $reserva->guardar($id,$dia,$profesor,$materia,$data,$observacion,$status,$sala_id,$periodo_id);	
			echo $id; // javascript espera este id para saber si el registro insertado está bien
		
			// comprobar repeticiones:
			$data_final = Util::clearparam($_POST['data_final']);
			
			if($data_final != "")
			{
				$data_final = date_create_from_format('d/m/Y',$data_final);
				
				// lloping +7 días . Si se excede el plazo, salir.
				$data->modify('+7 day');
				
				$diff = Util::ndate_diff($data->format("Y-m-d"),$data_final->format("Y-m-d"));
	
				while($diff > 0 || $data->format("Y-m-d") == $data_final->format("Y-m-d") )
				{
					
					$id_existente = $reserva->verificar($data, $sala_id,$periodo_id);
	
					if(!isset($id_existente[0]['id'])){
						// reserva duplicada para la fecha seleccionada.
						$id = 0;
						$reserva->guardar($id,$dia,$profesor,$materia,$data,$observacion,$status,$sala_id,$periodo_id);	
					}
				
					$data->modify('+7 day');
					$diff = Util::ndate_diff($data->format("Y-m-d"),$data_final->format("Y-m-d"));
				}
			
			}
			
			
		}
		
	}

}
?>