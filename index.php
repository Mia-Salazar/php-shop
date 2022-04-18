<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index.php</title>
</head>
<body>
	<form method="post" action="index.php" class="form">
		<label class="label" for="FullName">Nombre</label>
		<input class="input" id="FullName" placeholder="escribe tu nombre" name="FullName" type="text" />
		<label class="label" for="Email">Email</label>
		<input class="input" id="Email" placeholder="escribe tu email" name="Email" type="email" />
		<button class="button" type="submit">Enviar</button>
	</form>	
	<?php
		include "consultas.php";
		include "utilidades.php";
		if(isset($_POST["FullName"]) && isset($_POST["Email"])) {
			$userType = tipoUsuario($_POST["FullName"], $_POST["Email"]);
			if ($userType !== "no registrado") {
				setcookie("userType", $userType, time() + 7200);
			}
			getLoginStructure($userType, $_POST["FullName"]);
		}

	?>
</body>
</html>