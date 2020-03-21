<?php
	require 'Login.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$respuesta = Registro::InsertarNuevoDato($datos["id"],$datos["password"]);
		if($respuesta){
			echo "Se insertaron los datos correctamente";
		}else{
			echo "Ocurrio un error";
		}
	}

?>