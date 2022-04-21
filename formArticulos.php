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
			if (!isset($_POST['editOrDelete'])) {
				$data = ["Name" => "", "Cost" => "", "Price" => "" ,"CategoryID" => "1", "id" => ""];
			}
			if(isset($_POST['editOrDelete']) && $_POST['editOrDelete'] === 'delete') {
				$data = getProducto($_POST['id']);
				$data['id'] = $_POST['id'];
				
			}
			if(isset($_POST['editOrDelete']) && $_POST['editOrDelete'] === 'edit') {
				$data = getProducto($_POST['id']);
				$data['id'] = $_POST['id'];
			}
			if(isset($_POST['action'])) {
				$action = $_POST['action'];
				if ($action === "Crear") {
					if(anadirProducto($_POST['name'], $_POST['cost'], $_POST['price'], $_POST['categoryID'])) {
						$feedback = "Producto añadido correctamente";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1"];
					} else {
						$feedback = "No se pudo añadir el producto";
					}
				}
				if ($action === "Eliminar") {
					if(borrarProducto($id)) {
						$feedback = "Producto borrado correctamente";
						$id = "";
						$data = ["Name" => "", "Cost" => 0, "Price" => 0 ,"CategoryID" => "1"];
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
		}
	?>
	<form action="formArticulos.php" method="POST">
		<label>ID</label>
		<input type="text" name="identifier" disabled value=<?php echo $data["id"]; ?>><br>
		<label>Nombre producto </label>
		<input type="text" name="name" placeholder="nombre del producto" value=<?php echo $data["Name"]; ?>><br>
		<label>Coste del producto</label>
		<input type="number" name="cost" placeholder="coste del producto" value=<?php echo $data["Cost"]; ?>><br>
		<label>Precio del producto</label>
		<input type="number" name="price" placeholder="precio del producto" value=<?php echo $data["Price"]; ?>><br>
		<label>Categoría del producto: </label>
		<select name="categoryID">
			<?php pintaCategorias($data["CategoryID"]); ?>	
		</select><br>
		<input type="hidden" name="id" value=<?php echo $data["id"]; ?>><br>
		<?php
			if (!isset($_POST['editOrDelete'])) {
				echo "<input type='submit' name='action' value='Crear'>";
			}
			if (isset($_POST['editOrDelete']) && $_POST['editOrDelete'] === 'delete') {
				echo "<input type='submit' name='action' value='Eliminar'>";
			}
			if (isset($_POST['editOrDelete']) && $_POST['editOrDelete'] === 'edit') {
				echo "<input type='submit' name='action' value='Editar'>";
			}
		?>
	</form>
	<?php echo $feedback ?>
</body>
</html>