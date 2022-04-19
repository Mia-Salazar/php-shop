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
				echo "<h1>Crear producto</h1>";
				$id = "";
				$data = ["Name" => "", "Cost" => "", "Price" => "" ,"CategoryID" => "1"];
			}
			if(isset($_POST['action'])) {
				$action = $_POST['action'];
				if ($action === "Crear") {
					if(anadirProducto($_POST['name'], $_POST['cost'], $_POST['price'], $_POST['categoryID'])) {
						$feedback = "Producto añadido correctamente";
					} else {
						$feedback = "No se pudo añadir el producto";
					}
				}

			}
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
			if (!isset($_GET['edit']) && !isset($_GET['delete'])) {
				echo "<input type='submit' name='action' value='Crear'>";
			}
		?>
	</form>
	<?php echo $feedback ?>
</body>
</html>