<?php 

	include "query.php";


	function showCategories($defecto) {
		$data = getCategories();
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
		}
	}
	

	function showUsers(){
		$data = getUsersList();
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
				if ($row["Enabled"] === "1") {
					echo "<td class='rojo'>" . $row["Enabled"] . "</td>";
				} else {
					echo "<td>" . $row["Enabled"] . "</td>";
				}
				echo "</tr>";
			};
			echo "</table>";
		};
	}

		
	function showProducts($orden) {
		$data = getProducts($orden);
		$permissions = gertPermissions();
		if (is_string($data)) {
			echo $data;
		} else {
			echo "
				<table> 
					<tr>
						<th>
							<a href='articles.php?order=product.ProductID'>ID</a>
						</th>
						<th>
							<a href='articles.php?order=Name'>Nombre</a>
						</th>
						<th>
							<a href='articles.php?order=Cost'>Coste</a>
						</th>
						<th>
							<a href='articles.php?order=Price'>Precio</a>
						</th>
						<th>
							<a href='articles.php?order=category.Name'>Categoría</a>
						</th>
						<th>Acciones</th>
					</tr>
			";
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
					echo       "<a href='formArticles.php?Editar=" . $row["ProductID"] . "' >Editar</a> - 
						        <a href='formArticles.php?Borrar=" . $row["ProductID"] . "' >Eliminar</a>";
				}
				echo 	"</td>
					</tr>";
			};
			echo "</table>";
		};	
	}

?>