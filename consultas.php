<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		$DDBB = crearConexion();
		$query = "SELECT FullName, Enabled FROM user WHERE FullName ='" . $nombre . "' AND Email = '" . $correo . "'";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			$user = mysqli_fetch_assoc($data);
			if ($user["Enabled"] === 1) {
				if(esSuperadmin($nombre, $correo)) {
					return "superadmin";
				} else {
					return "autorizado";
				}
			} else {
				return "registrado";
			}
		} else {
			return "no registrado";
		}
		cerrarConexion($DDBB);
	}

	function esSuperadmin($nombre, $correo){
		$DDBB = crearConexion();
		$query = "SELECT setup.SuperAdminFullName as SuperAdmin FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin WHERE FullName ='" . $nombre . "' AND Email = '" . $correo . "'";
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
		$newPermission = $currentPermission === 1 ? 0 : 1;
		$DDBB = crearConexion();
		$query = "UPDATE setup SET Autenticación = " . $newPermission;   
		$data = mysqli_query($DDBB, $query);
		if ($data) {
			return $data;
		} else {
			echo "Error, no se pudo editar";
		}
		cerrarConexion($DDBB);
	}


	function getCategorias() {
		// Completar...	
	}


	function getListaUsuarios() {
		$DDBB = crearConexion();
		$query = "SELECT FullName, Enabled, Email FROM user ORDER BY FullName ASC";
		$data = mysqli_query($DDBB, $query);
		if (mysqli_num_rows($data) > 0) {
			return $data;
		} else {
			echo "Error, no hay usuario en el sistema";
		}
		cerrarConexion($DDBB);
	}


	function getProducto($ID) {
		// Completar...	
	}


	function getProductos($orden) {
		// Completar...	
	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		// Completar...	
	}


	function borrarProducto($id) {
		// Completar...	
	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		// Completar...	
	}

?>