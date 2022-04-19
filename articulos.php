<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>
	<h1>Lista de artículos</h1>
	<?php 
		include "utilidades.php";
		include "funciones.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "autorizado") {
			if (!isset($_GET['order'])) {
				$order = "product.ProductID";
			} else {
				$order = $_GET['order'];
			}
			$permissions = getPermisos();
			if ($permissions === '1') {
				echo "<a href='formArticulos.php' class='button'>Añadir producto</a>";
			}
			echo "
				<table> 
					<tr>
						<form action='articulos.php' method='get'>
							<th>
								<label>ID</label>
								<input type='submit' name='order' value='product.ProductID'>
							</th>
							<th>
								<label>Nombre</label>
								<input type='submit' name='order' value='Name'>
							</th>
							<th>
								<label>Coste</label>
								<input type='submit' name='order' value='Cost'>
							</th>
							<th>
								<label>Precio</label>
								<input type='submit' name='order' value='Price'>
							</th>
							<th>
								<label>Categoría</label>
								<input type='submit' name='order' value='category.Name'>
							</th>
							<th>Acciones</th>
						</form>
					</tr>
			";
			getProductsList($order, $permissions);
		}
	?>
	<a href="index.php">Volver al inicio</a>
</body>
</html>