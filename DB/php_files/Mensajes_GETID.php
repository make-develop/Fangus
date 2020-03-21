<?php
	require 'Mensajes.php';
	setlocale(LC_TIME, 'es_PE.UTF-8');
	date_default_timezone_set('America/Lima');

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$emisor = $datos["emisor"];
		$receptor = $datos["receptor"];
		$NameTableEmisor = "Mensajes_" . $emisor;

		$respuesta = Mensajes::solicitarMensajesUsuario($NameTableEmisor,$receptor);
		if($respuesta){
			echo json_encode(array("resultado"=>$respuesta));
		}else{
			echo json_encode(array("resultado"=>"No se pudo solicitar los mensajes"));
		}
	}

?>