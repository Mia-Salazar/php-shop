<?php 

	include "consultas.php";


	function pintaCategorias($defecto) {
		$data = getCategorias();
		if (is_string($data)) {
			echo $data;
		} else {
			while ($row = mysqli_fetch_assoc($data)) {
				if ($defecto == $row["CategoryID"]) {
					echo "<option selected='true' value='" . $row["CategoryID"] . "'>" . $row["Name"] . "</option>";
				} else {
					echo "<option value='" . $row["CategoryID"] . "'>" . $row["Name"] . "</option>";
				}
			}
		};
	}
	

	function pintaTablaUsuarios(){
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
				echo "<tr>
						<td>" . $row["FullName"] . "</td>
						<td>" . $row["Email"] . "</td>";
				if ($row["Enabled"] == "1") {
					echo "<td class='rojo'>" . $row["Enabled"] . "</td>";
				} else {
					echo "<td>" . $row["Enabled"] . "</td>";
				}
					echo "</tr>";
			};
			echo "</table>";
		};
	}

		
	function pintaProductos($orden) {
		$data = getProductos($orden);
		$permissions = getPermisos();
		if (is_string($data)) {
			echo $data;
		} else {
			while ($row = mysqli_fetch_assoc($data)) {
				echo "
					<tr>
						<td>" . $row["ProductID"] . "</td>
						<td>" . $row["Name"] . "</td>
						<td>" . $row["Cost"] . "</td>
						<td>" . $row["Price"] . "</td>
						<td>" . $row["Category"] . "</td>
						<td>";
				if ($permissions === '1') {
					echo "
						<form action='formArticulos.php' method='post'>
							<input type='hidden' name='id' value='" . $row["ProductID"] . "'>
							<input type='submit' name='editOrDelete' value='delete'> - 
							<input type='submit' name='editOrDelete' value='edit'>
						</form>";
				}
				echo "</td>
					</tr>";
			};
			echo "</table>";
		};	
	}

?>