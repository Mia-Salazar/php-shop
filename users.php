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
		include "functions.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "superadmin") {
			$permission = getPermisos();
			if (isset($_POST["permissionType"])) {
				cambiarPermisos();
				$permission = getPermisos();
			}
			echo "<p>Los permisos actuales están a " . $permission  . "</p><br>";
			echo "
				<form action='users.php' method='post'>
					<input type='submit' name='permissionType' value='Cambiar permisos'>
				</form>
			";
			pintaTablaUsuarios();

		} else {
			echo "<p>No tienes permiso para estar aquí.</p>";
		}

	?>
	<a href="index.php">Volver al inicio</a>

</body>
</html>