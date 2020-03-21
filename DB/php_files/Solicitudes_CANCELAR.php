<?php
	require 'Solicitudes.php';
	setlocale(LC_TIME, 'es_PE.UTF-8');
	date_default_timezone_set('America/Lima');

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);

		$emisor = $datos["emisor"];//Quien envio la solicitud es el numero 2
		$receptor = $datos["receptor"];//Quien envio la solicitud es el numero 3

		$token_tabla = Solicitudes::getTokenUser($receptor);

		if($token_tabla){

			$token = $token_tabla["token"];
			$NameTableEmisor = "Amigos_" . $emisor;//kevin
			$NameTableReceptor = "Amigos_" . $receptor;//paula

			$respuestaEnviarSolicitudEmisor = Solicitudes::EliminarSolicitud($NameTableEmisor,$receptor);//insertar una solicitud en nuestra tabla del emisor
			$respuestaEnviarSolicitudReceptor = Solicitudes::EliminarSolicitud($NameTableReceptor,$emisor);//insertar una solicitud en nuestra tabla del receptor

			if($respuestaEnviarSolicitudEmisor == -1){
				echo json_encode(array('respuesta'=>'-1','resultado' => 'Error de solicitud'));
				return;
			}

			if($respuestaEnviarSolicitudReceptor == -1){
				echo json_encode(array('respuesta'=>'-1','resultado' => 'Error de solicitud'));
				return;
			}

			if($respuestaEnviarSolicitudEmisor == 200 && $respuestaEnviarSolicitudReceptor == 200){
				echo json_encode(array('respuesta'=>'200','resultado' => 'Se cancelo la solicitud correctamente'));
				$arrayDatos = array('type' => 'solicitud','sub_type'=>'cancelar_solicitud',
						'user_envio_solicitud' =>$emisor);
				Solicitudes::EnviarNotification($token,$arrayDatos);
			}
		}else{
			echo json_encode(array('respuesta'=>"-1"));
		}	

	}

?>
