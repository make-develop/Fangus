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
		$ultimoMensaje = Solicitudes::obtenerUltimomMensaje($emisor,$receptor);

		if($token_tabla){

			$token = $token_tabla["token"];
			$nombreEmisor = $datosEmisor["nombre"];
			$apellidosEmisor = $datosEmisor["apellidos"];
			$nombreReceptor = $datosReceptor["nombre"];
			$apellidosReceptor = $datosReceptor["apellidos"];
			$UM = $ultimoMensaje["mensaje"];
			$UH = $ultimoMensaje["hora_del_mensaje"];
			$TP = $ultimoMensaje["tipo_mensaje"];

			$hora_de_aceptacion_amistad = strftime("%H:%M , %A, %d de %B de %Y");

			$respuestaEnviarSolicitudEmisor = Solicitudes::ActualizarDatos($NameTableEmisor,$receptor,4,$hora_de_aceptacion_amistad,3);//insertar una solicitud en nuestra tabla del emisor
			$respuestaEnviarSolicitudReceptor = Solicitudes::ActualizarDatos($NameTableReceptor,$emisor,4,$hora_de_aceptacion_amistad,2);//insertar una solicitud en nuestra tabla del receptor

			if($respuestaEnviarSolicitudEmisor == -1){
				echo json_encode(array('resultado' => 'Error de solicitud'));
			}

			if($respuestaEnviarSolicitudReceptor == -1){
				echo json_encode(array('resultado' => 'Error de solicitud'));
			}

			if($respuestaEnviarSolicitudEmisor == 200 && $respuestaEnviarSolicitudReceptor == 200){
				echo json_encode(array('respuesta'=>'200',
					"nombreCompleto"=>$nombreReceptor . " " .$apellidosReceptor,
					"UltimoMensaje"=>$UM,
					"hora"=>$UH,
					"type_mensaje"=>$TP));
				$arrayDatos = array('type' => 'solicitud','sub_type'=>'aceptar_solicitud',
					'user_envio_solicitud' =>$emisor,'user_envio_solicitud_nombre'=>$nombreEmisor . $apellidosEmisor,
					'hora_acepto_solicitud'=>$hora_de_aceptacion_amistad,'hora_del_mensaje'=>$UH,
					'ultimoMensaje'=>$UM,'type_mensaje'=>$TP,'cabezera' => 'Nuevo Amigo!',
				 	'cuerpo' => $nombreEmisor. " " . $apellidosEmisor. " acepto la solicitud de amitad");
				Solicitudes::EnviarNotification($token,$arrayDatos);
			}else{
				echo json_encode(array('respuesta'=>'-1'));
			}
		}else{
			echo json_encode(array('respuesta'=>'-1'));
		}

	}

?>
