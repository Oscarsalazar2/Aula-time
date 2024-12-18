<?php
require_once "db_mysqli.php";

class Reserva
{

	function abrir($id)
	{

		$db = new Database();

		$sql = ' select 
		a.id
		,a.sala_id
		,c.nombre as sala
		,a.periodo_id
		,b.nombre as periodo
		,a.Profesor_alumno
		,a.materia
		,a.status
		,a.observacion
		,date_format(a.dia,"%d/%m/%Y") as dia
		
			
	 from reserva a
	 
	 inner join periodo b on
	 a.periodo_id = b.id
	 
	 inner join sala c on
	 a.sala_id = c.id
	 
	 where a.id = ' . $id;

		return $db->query($sql);
	}



	function verificar($data, $sala, $periodo)
	{

		$db = new Database();

		$sql = ' select 
	a.id
			
	 from reserva a
	 
	 where a.sala_id =  ' . $sala . '
	 and a.periodo_id = ' . $periodo . '
	 and dia = "' . $data->format("Y-m-d") . '"; ';

		return $db->query($sql);
	}


	function verificarCompleto($data, $sala, $periodo)
	{
		$db = new Database();

		$sql = 'select * from reserva where sala_id =  ' . $sala . ' and periodo_id = ' . $periodo . ' and dia = "' . $data->format("Y-m-d") . '" ;';
		return $db->query($sql);
	}

	function eliminar($id)
	{
		$db = new Database();

		$sql = ' delete from reserva where id =' . $id;

		$db->query_update($sql);
		return 0;
	}

	function guardar($id, $dia, $profesor, $materia, $data, $observacion, $status, $sala, $periodo)
	{

		$db = new Database();

		// actualizar
		if ($id > 0) {
			$sql = 'update reserva set
			dia = "' . $data->format("Y-m-d") . '"
			,Profesor_alumno = "' . $profesor . '"
			,materia = "' . $materia . '"
			,observacion = "' . $observacion . '"
			,status = ' . $status . '
			
			where id  =	' . $id;

			$db->query_update($sql);
			return $id;
		}
		// guardar nuevo registro
		else {
			$sql = '
			
			INSERT INTO reserva
			(
			 sala_id
			 ,periodo_id
			 ,dia
			 ,Profesor_alumno
			 ,materia
			 ,status
			 ,observacion
			)
			VALUES
			(
			 
			  ' . $sala . ' -- sala_id - INT(11) NOT NULL
			 ,' . $periodo . ' -- periodo_id - INT(11) NOT NULL
			 ,"' . $data->format("Y-m-d") . '" -- dia - DATE NOT NULL
			 ,"' . $profesor . '" -- Profesor_alumno - VARCHAR(255)
			 ,"' . $materia . '" -- materia - VARCHAR(255)
			 ,' . $status . ' -- status - INT(11) NOT NULL
			 ,"' . $observacion . '" -- observacion - TEXT
			) ';

			return $db->query_insert($sql);
		}
	}


	function materiaMasReservas()
	{

		$db = new Database();

		$sql = '

	SELECT materia, COUNT(id) AS total
	FROM reserva
	GROUP BY materia
	HAVING COUNT(id) > (
    SELECT MIN(total_minimo)
    FROM (
        SELECT COUNT(id) AS total_minimo
        FROM reserva
        GROUP BY materia
    ) AS subquery
	)
	ORDER BY total DESC;

';


		return $db->query($sql);
	}


	function totalReservasMes($hoy)
	{
		$db = new Database();

		$sql = '  
		
		select count(id) as total from reserva where month(dia) = ' . $hoy->format("m") . ';';
		return $db->query($sql);
	}
}
