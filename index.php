<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="general.css">
	<title>Login</title>
</head>
<body class="body">
	<section class="wrapper">
		<form method="post" action="index.php">
			<h1>Iniciar sesión</h1>
			<label for="FullName">Usuario: </label>
			<input id="FullName" placeholder="Escribe tu nombre" name="FullName" type="text" />
			<label for="Email">Correo: </label>
			<input id="Email" placeholder="Escribe tu email" name="Email" type="email" />
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
					<p> Bienvenido, " . $name . ". Pulsa <a href='users.php'>aquí</a> para entrar al panel de usuarios</p>
					";
				} else if ($userType === "autorizado") {
					echo "
					<p> Bienvenido, " . $name . ". Pulsa <a href='articles.php'>aquí</a> para entrar al panel de artículos</p>
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
	</section>
</body>
</html>