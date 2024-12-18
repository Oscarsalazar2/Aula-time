<?php

/* clase de características generales y útiles */
class Util
{

	// limpiar parámetros que podrían causar inyección SQL
    public static function clearparam($param) {
	
		$badchars   =  array(")", "(", "'","\"",";","--","\\",">","..");
		return  str_replace($badchars,'',$param);

    }
	
	// comparación entre fechas
	public static function ndate_diff($date1, $date2) { 
		$current = $date1; 
		$datetime2 = date_create($date2); 
		$count = 0; 
		while(date_create($current) < $datetime2){ 
			$current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 
			$count++; 
		} 
		return $count; 
	} 
	
}


?>