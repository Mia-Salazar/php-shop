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
		include "funciones.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "superadmin") {
			$permission = getPermisos();
			if (isset($_POST["permissionType"])) {
				cambiarPermisos();
				$permission = getPermisos();
			}
			echo "<h1>Página de usuarios</h1>";
			echo "<h2>Permisos actuales:" . $permission  . "</h2>";
			echo "
				<form action='usuarios.php' method='post'>
					<input type='submit' name='permissionType' value='Cambiar valor de permisos'>
				</form>
			";

			pintaTablaUsuarios();

		}

	?>
	<a href="index.php" class="navigation">Volver atrás</a>

</body>
</html>