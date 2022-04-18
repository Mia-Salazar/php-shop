<?php
	function getLoginStructure($userType, $name) {
		if ($userType === "superadmin") {
			echo "
			<h1> Te damos la bienvenida, " . $name . "</h1>
			<a href='usuarios.php'>Ir a la lista de usuarios</a>
			";
		} else if ($userType === "autorizado") {
			echo "
			<h1> Te damos la bienvenida, " . $name . "</h1>
			<a href='articulos.php'>Ir a la lista de artículos</a>
			";
		} else if ($userType === "registrado") {
			echo "
			<h1> Te damos la bienvenida, " . $name . "</h1>
			<h2>No tienes permisos para acceder</h2>
			";
		} else if ($userType === "no registrado") {
			echo "
			<h1> Te damos la bienvenida Usuario no registrado</h1>
			";
		}
	}
?>