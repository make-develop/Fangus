<?php
	require 'Token.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$respuesta = Token::InsertarNuevoDato($datos["id"],$datos["token"]);
		if($respuesta){
			echo json_encode(array('resultado' => 'El token se subio correctamente'));
		}else{
			Token::ActualizarDatos($datos["id"],$datos["token"]);
			echo json_encode(array('resultado' => 'El token se subio correctamente'));
		}
	}

?>