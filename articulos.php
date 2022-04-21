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
						<th>
							<a href='articulos.php?order=product.ProductID'>ID</a>
						</th>
						<th>
							<a href='articulos.php?order=Name'>Nombre</a>
						</th>
						<th>
							<a href='articulos.php?order=Cost'>Coste</a>
						</th>
						<th>
							<a href='articulos.php?order=Price'>Precio</a>
						</th>
						<th>
							<a href='articulos.php?order=category.Name'>Categoría</a>
						</th>
						<th>Acciones</th>
					</tr>
			";
			pintaProductos($order);
		} else {
			echo "<p>No tienes permiso para estar aquí.</p>";
		}
	?>
	<a href="index.php">Volver al inicio</a>
</body>
</html>