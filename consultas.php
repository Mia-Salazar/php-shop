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
			echo false;
		}
		cerrarConexion($DDBB);
	}


	function getPermisos() {
		// Completar...	
	}


	function cambiarPermisos() {
		// Completar...	
	}


	function getCategorias() {
		// Completar...	
	}


	function getListaUsuarios() {
		// Completar...	
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