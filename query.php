<?php 

	include "connection.php";

	function userType($nombre, $correo){
		$DDBB = createConnection();
		$query = "SELECT FullName, Enabled FROM user WHERE FullName ='" . $nombre . "' AND Email = '" . $correo . "'";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			$user = mysqli_fetch_assoc($data);
			if(isSuperAdmin($nombre, $correo)) {
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
		closeConnection($DDBB);
	}

	function isSuperAdmin($nombre, $correo){
		$DDBB = createConnection();
		$query = "SELECT setup.SuperAdmin FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin 
		WHERE FullName ='" . $nombre . "' AND Email = '" . $correo . "'";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return true;
		} else {
			return false;
		}
		closeConnection($DDBB);
	}


	function gertPermissions() {
		$DDBB = createConnection();
		$query = "SELECT Autenticación FROM setup";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			$permission = mysqli_fetch_assoc($data);
			return $permission["Autenticación"];
		} else {
			echo "Error, no hay valor almacenado en la columna 'Autenticación'";
		}
		closeConnection($DDBB);
	}


	function changePermissions() {
		$currentPermission = gertPermissions();
		$newPermission = $currentPermission === '1' ? '0' : '1';
		$DDBB = createConnection();
		$query = "UPDATE setup SET Autenticación = " . $newPermission;   
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo editar los permisos";
		}
		closeConnection($DDBB);
	}


	function getCategories() {
		$DDBB = createConnection();
		$query = "SELECT CategoryID, Name FROM category ORDER BY Name ASC";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return $data;
		} else {
			echo "No hay nada en la lista de categorías";
		}
		closeConnection($DB);
	}


	function getUsersList() {
		$DDBB = createConnection();
		$query = "SELECT FullName, Email, Enabled FROM user ORDER BY FullName ASC";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return $data;
		} else {
			echo "Error, no hay usuarios en el sistema";
		}
		closeConnection($DDBB);
	}


	function getProduct($ID) {
		$DDBB = createConnection();
		$query = "SELECT ProductID, Name, Cost, Price, CategoryID FROM product WHERE ProductID = '" . $ID . "'";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			$product = mysqli_fetch_assoc($data);
			return $product;
		} else {
			echo "Error, no hay un producto con este ID";
		}
		closeConnection($DDBB);	
	}


	function getProducts($orden) {
		$DDBB = createConnection();
		$query = "SELECT product.ProductID, product.Name, product.Cost, product.Price, category.Name
		as Category FROM product INNER JOIN category ON category.CategoryID = product.CategoryID ORDER BY " . $orden . " ASC";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return $data;
		} else {
			echo "No hay nada en la lista de productos";
		}
		closeConnection($DB);
	}


	function addProduct($nombre, $coste, $precio, $categoria) {
		$DDBB = createConnection();
		$query = "INSERT INTO product (Name, Cost, Price, CategoryID) 
				VALUES ('$nombre', '$coste', '$precio', '$categoria')";  
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo añadir el producto";
		}
		closeConnection($DDBB);	
	}


	function deleteProduct($id) {
		$DDBB = createConnection();
		$query = "DELETE FROM product WHERE ProductID = '" . $id . "'";
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo eliminar el producto";
		}
		closeConnection($DB);
	}


	function editProduct($id, $nombre, $coste, $precio, $categoria) {
		$DDBB = createConnection();
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
		closeConnection($DDBB);		
	}

?>