<?php
	require 'Token.php';

	if($_SERVER['REQUEST_METHOD']=='GET'){

		if(isset($_GET['id'])){
			$identificador = $_GET['id'];

			$respuesta = Token::ObtenerDatosPorId($identificador);

			if($respuesta){
				echo $respuesta["token"];
			}else{
				echo json_encode(array('resultado' => 'El usuario no existe'));
			}
		}else{
			echo json_encode(array('resultado' => 'Falta el identificador'));
		}
	}
?>