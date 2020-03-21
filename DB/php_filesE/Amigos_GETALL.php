<?php
	require 'Amigos.php';

	if($_SERVER['REQUEST_METHOD']=='GET'){
		try{
			$identificador = $_GET['id'];
			$Respuesta = Amigos::ObtenerTodosLosUsuarios('Amigos_'.$identificador);
			echo json_encode(array('resultado' => $Respuesta));
		}catch(PDOException $e){
			echo json_encode(array('resultado' => 'Ocurrio un error, intentelo mas tarde'));
		}
	}

?>