<?php
	function getLoginStructure($userType, $name) {
		if ($userType === "superadmin") {
			echo "
			<h1> Te damos la bienvenida, " . $name . "</h1>
			<a href='usuarios.php' class='navigation'>Ir a la lista de usuarios</a>
			";
		} else if ($userType === "autorizado") {
			echo "
			<h1> Te damos la bienvenida, " . $name . "</h1>
			<a href='articulos.php' class='navigation'>Ir a la lista de artículos</a>
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

	function getUsersList() {
		$data = getListaUsuarios();
		if (is_string($data)) {
			echo $data;
		} else {
			echo "
				<table> 
					<tr>
						<th>Nombre</th>
						<th>Email</th>
						<th>Autorizado</th>
					</tr>
			";
			while ($row = mysqli_fetch_assoc($data)) {
				if ($row["Enabled"] == "1") {
					echo "<tr class='rojo'>";
				} else {
					echo "<tr>";
				}
				echo "
						<td>" . $row["FullName"] . "</td>
						<td>" . $row["Email"] . "</td>
						<td>" . $row["Enabled"] . "</td>
					</tr>";
			};
			echo "</table>";
		};
	}
?>