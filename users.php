<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="general.css">
	<link rel="stylesheet" type="text/css" href="users.css">
	<title>Usuarios</title>
</head>
<body class="body">
	<h1>Usuarios</h1>
	<p>Aquí se puede ver todos los usuarios de la plataforma y ver sus permisos.Los usuarios autorizados tendrán un 1 y los no autorizados un 0</p>
	<?php 
		include "functions.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "superadmin") {
			$permission = gertPermissions();
			if (isset($_POST["permissionType"])) {
				changePermissions();
				$permission = gertPermissions();
			}
			echo "<div><p>Los permisos actuales están a " . $permission  . "</p>";
			echo "
				<form action='users.php' method='post'>
					<input class='button' type='submit' name='permissionType' value='Cambiar permisos'>
				</form></div>
			";
			showUsers();

		} else {
			echo "<p>No tienes permiso para estar aquí.</p>";
		}

	?>
	<a class="button" href="index.php">Volver al inicio</a>

</body>
</html>