<?php
	require 'Token.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$respuesta = Token::InsertarNuevoDato($datos["id"],$datos["token"]);
		if($respuesta){
			echo "Se insertaron los datos correctamente";
		}else{
			echo "Ocurrio un error";
		}
	}

?>