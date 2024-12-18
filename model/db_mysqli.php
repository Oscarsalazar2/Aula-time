<?php


class Database
{
	private $link;

	function __construct()
	{
		global $cfg;

		$this->link = mysqli_connect(
			$cfg->db_localhost,
			$cfg->db_user,
			$cfg->db_password,
			$cfg->db_name,
			$cfg->db_port
		) or die("Error de Conexión: " . mysqli_connect_error());
	}

	function query($sql)
	{


		mysqli_query($this->link, "SET NAMES utf8");
		$result = mysqli_query($this->link, $sql) or die(mysqli_error($this->link));

		$array_result = array();


		
		while ($row = mysqli_fetch_array($result)) {
			$array_result[] = $row;
		}

		return $array_result;
	}

	function query_insert($sql)
	{

		mysqli_query($this->link, "SET NAMES utf8");
		mysqli_query($this->link,  $sql) or die(mysqli_error($this->link));

		return mysqli_insert_id($this->link);
	}

	function query_update($sql)
	{

		mysqli_query($this->link, "SET NAMES utf8");
		mysqli_query($this->link,  $sql) or die(mysqli_error($this->link));
	}
}
