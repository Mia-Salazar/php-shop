<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="general.css">
	<link rel="stylesheet" type="text/css" href="articles.css">
	<title>Articulos</title>
</head>
<body>
	<h1>Lista de artículos</h1>
	<p>En esta página se pueden ver todos los artículos disponibles. Si tiene permisos puede añadir, editar o eliminar productos.</p>
	<p>Si pulsa en las cabeceras de la tabla, se ordenará la tabla de forma ascendente por esa columna</p>
	<?php 
		include "functions.php";
		if (isset($_COOKIE['userType']) && $_COOKIE['userType'] === "autorizado") {
			if (!isset($_GET['order'])) {
				$order = "product.ProductID";
			} else {
				$order = $_GET['order'];
			}
			$permissions = gertPermissions();
			if ($permissions === '1') {
				echo "<div class='button-container'><a class='button' href='formArticles.php?Anadir'>Añadir producto</a></div>";
			}
			showProducts($order);
		} else {
			echo "<p>No tienes permiso para estar aquí.</p>";
		}
	?>
	<a class="secondary-button" href="index.php">Volver al inicio</a>
</body>
</html>