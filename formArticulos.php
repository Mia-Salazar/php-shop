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
			if (!isset($_GET['edit']) && !isset($_GET['delete'])) {
				$id = "";
				$data = ["Name" => "", "Cost" => "", "Price" => "" ,"CategoryID" => "1"];
			}
			if(isset($_GET['delete'])) {
				$id = $_GET['delete'];
				$data = getProducto($id);
			}
			if(isset($_POST['action'])) {
				$action = $_POST['action'];
				if ($action === "Crear" || $id === "") {
					if(anadirProducto($_POST['name'], $_POST['cost'], $_POST['price'], $_POST['categoryID'])) {
						$feedback = "Producto añadido correctamente";
					} else {
						$feedback = "No se pudo añadir el producto";
					}
				}
				if ($action === "Eliminar") {
					if(borrarProducto($id)) {
						$feedback = "Producto borrado correctamente";
						$id = "";
						$data = ["Name" => "", "Cost" => "", "Price" => "" ,"CategoryID" => "1"];
					} else {
						$feedback = "No se pudo borrar el producto";
					}
				}

			}
		} else {
			$id = "";
			$data = ["Name" => "", "Cost" => "", "Price" => "" ,"CategoryID" => "1"];
		}
	?>
	<form action="formArticulos.php" method="POST">
		<label>Nombre producto </label>
		<input type="text" name="name" value=<?php echo $data["Name"]; ?>><br>
		<label>Coste del producto</label>
		<input type="number" name="cost" placeholder="coste del producto" value=<?php echo $data["Cost"]; ?>><br>
		<label>Precio del producto</label>
		<input type="number" name="price" placeholder="precio del producto" value=<?php echo $data["Price"]; ?>><br>
		<label>Categoría del producto: </label>
		<select name="categoryID">
			<?php pintaCategorias($data["CategoryID"]); ?>	
		</select><br>
		<input type="hidden" name='id' value=<?php echo $id; ?>>
		<?php
			if ($id === "") {
				echo "<input type='submit' name='action' value='Crear'>";
			}
			if (isset($_GET['delete']) && $id !== "") {
				echo "<input type='submit' name='action' value='Eliminar'>";
			}
		?>
	</form>
	<?php echo $feedback ?>
</body>
</html>