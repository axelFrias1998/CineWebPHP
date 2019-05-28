<?php
	function conexion(){
		//CONEXION
		$host="127.0.0.1";
		$port=3306;
		$socket="";
		$user="root";
		$password="Suripanta.98";
		$dbname="cinedb";
		$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
			or die ('Could not connect to the database server' . mysqli_connect_error());
		
		return $con;	
	}
?>