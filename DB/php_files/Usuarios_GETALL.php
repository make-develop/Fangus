<?php

	require 'Usuarios.php';

	if($_SERVER['REQUEST_METHOD']=='GET'){
		try{
			$Respuesta = Usuarios::ObtenerTodosLosUsuarios();
			echo json_encode(array('resultado' => $Respuesta));
		}catch(PDOException $e){
			echo json_encode(array('resultado' => 'Ocurrio un error, intentelo mas tarde'));
		}
	}
?>