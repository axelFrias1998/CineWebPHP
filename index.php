<?php
	ini_set("display errors", E_ALL);
	
	//CONEXION
	$cnx = mysqli_connect("127.0.0.1:3306", "root", "", "CineDB");
	
	//COMPROBAR CONEXION
	if (mysqli_connect_errno()) {
		printf("Conexion fallida: %s\n", mysqli_connect_error());
		exit();
	}
	
	echo("Conexion exitosa");
	
	
	//RECUPERAR LOS REGISTROS
	$res = mysqli_query($cnx, "SELECT * FROM TipoProyeccion");
	echo("<table  border=1>");
	while ($registro = mysqli_fetch_row($res)){
		echo("<tr><td>$registro[0]</td><td>$registro[1]</td><td>$registro[2]</td></tr>");
	}
	echo("</table>");

	
	mysqli_free_result($res);
	mysqli_close($cnx);
?>