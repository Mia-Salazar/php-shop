<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="general.css">
	<link rel="stylesheet" type="text/css" href="form.css">
	<title>Formulario de artículos</title>
</head>
<body>
	<a class="secondary-button" href="articles.php">Volver</a>
	<?php 

		include "functions.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "autorizado") {
			$feedback = "";
			if (isset($_GET['Anadir'])) {
				$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1", "id" => ""];
			}
			if(isset($_GET['Borrar'])) {
				$data = getProduct($_GET['Borrar']);
				$data['id'] = $_GET['Borrar'];
			}
			if(isset($_GET['Editar'])) {
				$data = getProduct($_GET['Editar']);
				$data['id'] = $_GET['Editar'];
			}
			if(isset($_GET['action'])) {
				$action = $_GET['action'];
				if ($action === "Añadir") {
					if(addProduct($_GET['name'], $_GET['cost'], $_GET['price'], $_GET['categoryID'])) {
						$feedback = "Se ha añadido el producto";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1", "id" => ""];
					} else {
						$feedback = "No se ha añadido el producto";
					}
				}
				if ($action === "Borrar") {
					if(deleteProduct($_GET['id'])) {
						$feedback = "Se ha borrado el producto";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1", "id" => ""];
					} else {
						$feedback = "No se ha borrado el producto";
					}
				}
				if ($action === "Editar") {
					if(editProduct($_GET['id'], $_GET['name'], $_GET['cost'], $_GET['price'], $_GET['categoryID'])) {
						$feedback = "Se ha editado el producto";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1", "id" => ""];
					} else {
						$feedback = "No se ha editado el producto";
					}
				}

			}
			echo "
					<form action='formArticles.php' method='GET'>
						<label>ID: </label>
						<input type='text' name='identifier' disabled value=" . $data['id'] . ">
						<label>Nombre producto: </label>
						<input type='text' name='name' placeholder='nombre' value=" . $data['Name'] . ">
						<label>Coste: </label>
						<input type='number' name='cost' placeholder='coste' value=" . $data['Cost'] . ">
						<label>Precio: </label>
						<input type='number' name='price' placeholder='precio' value=" . $data['Price'] . ">
						<label>Categoría: </label>
						<select name='categoryID'>";
							echo  showCategories($data['CategoryID']);
						echo "</select>
						<input type='hidden' name='id' value=" . $data['id'] . ">";
							if (isset($_GET['Anadir']) || !isset($_GET['Borrar']) && !isset($_GET['Editar'])) {
								echo "<input class='button' type='submit' name='action' value='Añadir'>";
							}
							if (isset($_GET['Borrar'])) {
								echo "<input class='button' type='submit' name='action' value='Borrar'>";
							}
							if (isset($_GET['Editar'])) {
								echo "<input class='button' type='submit' name='action' value='Editar'>";
							}
				echo "</form>
					  <p> " . $feedback . "</p>";
		} else {
			echo "<p>No tienes permiso para estar aquí</p>";
		}
	?>
</body>
</html>