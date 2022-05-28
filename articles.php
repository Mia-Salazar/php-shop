<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>
	<h1>Lista de artículos</h1>
	<a href="index.php">Volver al inicio</a>
	<?php 
		include "functions.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "autorizado") {
			if (!isset($_GET['order'])) {
				$order = "product.ProductID";
			} else {
				$order = $_GET['order'];
			}
			$permissions = getPermisos();
			if ($permissions === '1') {
				echo "<a href='formArticles.php?Anadir'>Añadir producto</a>";
			}
			pintaProductos($order);
		} else {
			echo "<p>No tienes permiso para estar aquí.</p>";
		}
	?>
</body>
</html>