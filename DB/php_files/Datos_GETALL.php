<?php
	require 'Datos.php';

	if($_SERVER['REQUEST_METHOD']=='GET'){

		if(isset($_GET['id'])){
			$identificador = $_GET['id'];

			$respuesta = Datos::ObtenerTodoLosDatos($identificador);

			$contenedor = array();

			if($respuesta){
				$contenedor["resultado"] = $respuesta;
				echo json_encode($contenedor);
			}else{
				echo json_encode(array('resultado' => 'El usuario no existe'));
			}
		}else{
			echo json_encode(array('resultado' => 'Falta el identificador'));
		}
	}
?>