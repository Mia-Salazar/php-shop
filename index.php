<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>
	<form method="post" action="index.php">
		<label for="FullName">Usuario: </label>
		<input id="FullName" placeholder="Escribe tu nombre" name="FullName" type="text" />
		<br><br>
		<label for="Email">Correo: </label>
		<input id="Email" placeholder="Escribe tu email" name="Email" type="email" />
		<br><br>
		<button type="submit">Enviar</button>
	</form>	
	<?php
		include "query.php";
		if(isset($_POST["FullName"]) && isset($_POST["Email"])) {
			$userType = userType($_POST["FullName"], $_POST["Email"]);
			$name = $_POST["FullName"];
			setcookie("userType", $userType, time() + 7200);
			if ($userType === "superadmin") {
				echo "
				<p> Bienvenido, " . $name . ". Pulsa <a href='users.php'>AQUÍ</a> para entrar al panel de usuarios</p>
				";
			} else if ($userType === "autorizado") {
				echo "
				<p> Bienvenido, " . $name . ". Pulsa <a href='articles.php'>AQUÍ</a> para entrar al panel de artículos</p>
				";
			} else if ($userType === "registrado") {
				echo "
				<p> Bienvenido, " . $name . ". No tienes permisos para acceder</p>
				";
			} else if ($userType === "no registrado") {
				echo "
				<p>El usuario no está registrado en el sistema</p>
				";
			}
		}

	?>
</body>
</html>