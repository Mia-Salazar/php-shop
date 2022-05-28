<?php 

	function createConnection() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "pac3_daw";
		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);
		if (!$conexion) {
			die("<p>Error al conectar con la BBDD: " . mysqli_connect_error() . "</p>");
		}
		return $conexion;
	}


	function closeConnection($conexion) {
		mysqli_close($conexion);
	}


?>