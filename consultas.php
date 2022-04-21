<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		$DDBB = crearConexion();
		$query = "SELECT FullName, Enabled FROM user WHERE FullName ='" . $nombre . "' AND Email = '" . $correo . "'";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			$user = mysqli_fetch_assoc($data);
			if(esSuperadmin($nombre, $correo)) {
				return "superadmin";
			} else {
				if ($user["Enabled"] === '1') {
					return "autorizado";
				} else {
					return "registrado";
				}
			}
		} else {
			return "no registrado";
		}
		cerrarConexion($DDBB);
	}

	function esSuperadmin($nombre, $correo){
		$DDBB = crearConexion();
		$query = "SELECT setup.SuperAdmin FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin WHERE FullName ='" . $nombre . "' AND Email = '" . $correo . "'";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return true;
		} else {
			return false;
		}
		cerrarConexion($DDBB);
	}


	function getPermisos() {
		$DDBB = crearConexion();
		$query = "SELECT Autenticación FROM setup";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			$permission = mysqli_fetch_assoc($data);
			return $permission["Autenticación"];
		} else {
			echo "Error, no hay valor almacenado en la columna 'Autenticación'";
		}
		cerrarConexion($DDBB);
	}


	function cambiarPermisos() {
		$currentPermission = getPermisos();
		$newPermission = $currentPermission === '1' ? '0' : '1';
		$DDBB = crearConexion();
		$query = "UPDATE setup SET Autenticación = " . $newPermission;   
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo editar los permisos";
		}
		cerrarConexion($DDBB);
	}


	function getCategorias() {
		$DDBB = crearConexion();
		$query = "SELECT CategoryID, Name FROM category ORDER BY Name ASC";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return $data;
		} else {
			echo "No hay nada en la lista de categorías";
		}
		cerrarConexion($DB);
	}


	function getListaUsuarios() {
		$DDBB = crearConexion();
		$query = "SELECT FullName, Email, Enabled FROM user ORDER BY FullName ASC";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return $data;
		} else {
			echo "Error, no hay usuarios en el sistema";
		}
		cerrarConexion($DDBB);
	}


	function getProducto($ID) {
		$DDBB = crearConexion();
		$query = "SELECT ProductID, Name, Cost, Price, CategoryID FROM product WHERE ProductID = '" . $ID . "'";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			$product = mysqli_fetch_assoc($data);
			return $product;
		} else {
			echo "Error, no hay un producto con este ID";
		}
		cerrarConexion($DDBB);	
	}


	function getProductos($orden) {
		$DDBB = crearConexion();
		$query = "SELECT product.ProductID, product.Name, product.Cost, product.Price, category.Name as Category FROM product INNER JOIN category ON category.CategoryID = product.CategoryID ORDER BY " . $orden . " ASC";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return $data;
		} else {
			echo "No hay nada en la lista de productos";
		}
		cerrarConexion($DB);
	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$DDBB = crearConexion();
		$query = "INSERT INTO product (Name, Cost, Price, CategoryID) 
				VALUES ('$nombre', '$coste', '$precio', '$categoria')";  
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo añadir el producto";
		}
		cerrarConexion($DDBB);	
	}


	function borrarProducto($id) {
		$DDBB = crearConexion();
		$query = "DELETE FROM product WHERE ProductID = '" . $id . "'";
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo eliminar el producto";
		}
		cerrarConexion($DB);
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$DDBB = crearConexion();
		$query = "UPDATE product SET Name = '" . $nombre . "'" .
				", Cost = '" . $coste . "'" .
				", Price = '" . $precio . "'" . 
				", CategoryID =" . $categoria . 
				" WHERE ProductID =" . $id; 
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo editar el producto";
		}
		cerrarConexion($DDBB);		
	}

?>