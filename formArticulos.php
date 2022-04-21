<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>
<body>
	<?php 

		include "funciones.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "autorizado") {
			$feedback = "";
			if (isset($_GET['Anadir'])) {
				$data = ["Name" => "", "Cost" => "", "Price" => "" ,"CategoryID" => "1", "id" => ""];
			}
			if(isset($_GET['Borrar'])) {
				$data = getProducto($_GET['Borrar']);
				$data['id'] = $_GET['Borrar'];
				
			}
			if(isset($_GET['Editar'])) {
				$data = getProducto($_GET['Editar']);
				$data['id'] = $_GET['Editar'];
			}
			if(isset($_POST['action'])) {
				$action = $_POST['action'];
				if ($action === "Añadir") {
					if(anadirProducto($_POST['name'], $_POST['cost'], $_POST['price'], $_POST['categoryID'])) {
						$feedback = "Producto añadido correctamente";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1", "id" => ""];
					} else {
						$feedback = "No se pudo añadir el producto";
					}
				}
				if ($action === "Borrar") {
					if(borrarProducto($id)) {
						$feedback = "Producto borrado correctamente";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1", "id" => ""];
					} else {
						$feedback = "No se pudo borrar el producto";
					}
				}
				if ($action === "Editar") {
					if(editarProducto($_POST['id'], $_POST['name'], $_POST['cost'], $_POST['price'], $_POST['categoryID'])) {
						$feedback = "Producto editado correctamente";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1", "id" => ""];
					} else {
						$feedback = "No se pudo editar el producto";
					}
				}

			}
			echo "
					<form action='formArticulos.php' method='POST'>
						<label>ID: </label>
						<input type='text' name='identifier' disabled value=" . $data['id'] . "><br><br>
						<label>Nombre producto: </label>
						<input type='text' name='name' placeholder='nombre' value=" . $data['Name'] . "><br><br>
						<label>Coste: </label>
						<input type='number' name='cost' placeholder='coste' value=" . $data['Cost'] . "><br><br>
						<label>Precio: </label>
						<input type='number' name='price' placeholder='precio' value=" . $data['Price'] . "><br><br>
						<label>Categoría: </label>
						<select name='categoryID'>";
							echo  pintaCategorias($data['CategoryID']);
						echo "</select><br><br>
						<input type='hidden' name='id' value=" . $data['id'] . ">";
							if (isset($_GET['Anadir'])) {
								echo "<input type='submit' name='action' value='Añadir'>";
							}
							if (isset($_GET['Borrar'])) {
								echo "<input type='submit' name='action' value='Borrar'>";
							}
							if (isset($_GET['Editar'])) {
								echo "<input type='submit' name='action' value='Editar'>";
							}
					echo "</form>
					<p> " . $feedback . "</p>";
		} else {
			echo "<p>No tienes permiso para estar aquí</p>";
		}
	?>

	<a href="articulos.php">Volver</a>
</body>
</html>