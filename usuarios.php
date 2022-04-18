<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Usuarios</title>
</head>
<body>

	<?php 
		include "utilidades.php";
		include "funciones.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "superadmin") {
			echo "<h1>Página de usuarios</h1>";
			echo "<h2>Permisos actuales: " . getPermisos() . "</h2>";
			echo "
				<form action='usuarios.php' method='post'>
					<input name='permissionType' value='" .  getPermisos() . "' class='button'>
					<button type='submit'class='button'>Cambiar valor de permisos</button>
				</form>
			";
			if (isset($_POST["permissionType"])) {
				cambiarPermisos();
			}
			getUsersList();

		}

	?>
	<a href="index.php" class="navigation">Volver atrás</a>

</body>
</html>