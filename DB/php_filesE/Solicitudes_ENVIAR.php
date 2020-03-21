<?php
	require 'Solicitudes.php';
	setlocale(LC_TIME, 'es_PE.UTF-8');
	date_default_timezone_set('America/Lima');

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$emisor = $datos["emisor"];//Quien envio la solicitud es el numero 2
		$receptor = $datos["receptor"];//Quien envio la solicitud es el numero 3
		$NameTableEmisor = "Amigos_" . $emisor;//kevin
		$NameTableReceptor = "Amigos_" . $receptor;//paula

		$token_tabla = Solicitudes::getTokenUser($receptor);
		$datosEmisor = Solicitudes::obtenerDatosUsuario($emisor);
		$datosReceptor = Solicitudes::obtenerDatosUsuario($receptor);

		if($token_tabla){

			$token = $token_tabla["token"];
			$nombreEmisor = $datosEmisor["nombre"];
			$apellidosEmisor = $datosEmisor["apellidos"];
			$nombreReceptor = $datosReceptor["nombre"];
			$apellidosReceptor = $datosReceptor["apellidos"];


			$hora_de_solicitud = strftime("%H:%M , %A, %d de %B de %Y");

			$respuestaEnviarSolicitudEmisor = Solicitudes::EnviarSolicitud($NameTableEmisor,$receptor,2,$hora_de_solicitud);//insertar una solicitud en nuestra tabla del emisor
			$respuestaEnviarSolicitudReceptor = Solicitudes::EnviarSolicitud($NameTableReceptor,$emisor,3,$hora_de_solicitud);//insertar una solicitud en nuestra tabla del receptor

			if($respuestaEnviarSolicitudEmisor == -1){//Si nuestra tabla de emisor no existe
				Solicitudes::CreateTable($NameTableEmisor);
				$respuestaEnviarSolicitudEmisor = Solicitudes::EnviarSolicitud($NameTableEmisor,$receptor,2,$hora_de_solicitud);//insertar una solicitud en nuestra tabla del emisor
			}

			if($respuestaEnviarSolicitudReceptor == -1){//Si nuestra tabla de receptor no existe
				Solicitudes::CreateTable($NameTableReceptor);
				$respuestaEnviarSolicitudReceptor = Solicitudes::EnviarSolicitud($NameTableReceptor,$emisor,3,$hora_de_solicitud);//insertar una solicitud en nuestra tabla del receptor
			}

			if($respuestaEnviarSolicitudEmisor == 200 && $respuestaEnviarSolicitudReceptor == 200){
				echo json_encode(array('respuesta'=>"200",'estado'=>"2","nombreCompleto"=>$nombreReceptor . " " .$apellidosReceptor,"hora"=>$hora_de_solicitud));
				$arrayDatos = array('type' => 'solicitud','sub_type'=>'enviar_solicitud',
					'user_envio_solicitud' =>$emisor,'user_envio_solicitud_nombre'=>$nombreEmisor . $apellidosEmisor,
					'hora'=>$hora_de_solicitud,'cabezera' => 'Solicitud De Amistad',
				 	'cuerpo' => $nombreEmisor. " " . $apellidosEmisor. " Te envio una solicitud de amitad");
				Solicitudes::EnviarNotification($token,$arrayDatos);
			}else{
				echo json_encode(array('respuesta'=>"-1"));
			}
		}else{
			echo json_encode(array('respuesta'=>"-1"));
		}	
	
	}

?>
