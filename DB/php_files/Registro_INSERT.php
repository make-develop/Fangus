<?php
	require 'Registro.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$respuesta = Registro::InsertarNuevoDato($datos["id"],$datos["nombre"],$datos["apellidos"],$datos["fecha_nacimiento"],$datos["correo"],$datos["telefono"],$datos["genero"]);
		$r2 = Registro::InsertarEnTablaLogin($datos["id"],$datos["password"]);
		if($respuesta && $r2){
			Registro::CreateTableMensajes($datos["id"]);
			Registro::CreateTableAmigos($datos["id"]);
			echo json_encode(array('resultado' => 'El usuario se registro correctamente'));
		}else{
			echo json_encode(array('resultado' => 'El usuario ya existe, por favor inserte otro usuario'));
		}
	}

?>