<?php
	require 'Login.php';

	if($_SERVER['REQUEST_METHOD']=='GET'){
		try{
			$Respuesta = Registro::ObtenerTodosLosUsuarios();
			echo json_encode($Respuesta);
		}catch(PDOException $e){
			echo json_encode(array('resultado' => 'Ocurrio un error, intentelo mas tarde'));
		}
	}

?>