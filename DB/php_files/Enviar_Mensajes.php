<?php
	require 'Mensajes.php';
	setlocale(LC_TIME, 'es_PE.UTF-8');
	date_default_timezone_set('America/Lima');

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$datos = json_decode(file_get_contents("php://input"),true);
		$emisor = $datos["emisor"];
		$receptor = $datos["receptor"];
		$mensaje = $datos["mensaje"];
		$NameTableEmisor = "Mensajes_" . $emisor;
		$NameTableReceptor = "Mensajes_" . $receptor;

		$token_tabla = Mensajes::getTokenUser($receptor);

		if($token_tabla){

			$token = $token_tabla["token"];

			$fechaActual = getdate();
			$segundos = $fechaActual['seconds'];
			$minutos = $fechaActual['minutes'];
			$hora = $fechaActual['hours'];
			$dia = $fechaActual['mday'];
			$mes = $fechaActual['mon'];
			$year = $fechaActual['year'];

			$miliseconds = DateTime::createFromFormat('U.u',microtime(true));

			$id_user_emisor = $emisor . "_" . $hora . $minutos . $segundos . $miliseconds->format("u");
			$id_user_receptor = $receptor . "_" . $hora . $minutos . $segundos . $miliseconds->format("u");

			$hora_del_mensaje = strftime("%H:%M , %A, %d de %B de %Y");

			$MEE = false; 
			$MER = false;

			$respuestaEnviarMensajeEmisor = Mensajes::EnviarMensaje($NameTableEmisor,$receptor,$id_user_receptor,$mensaje,1,$hora_del_mensaje);
			if($respuestaEnviarMensajeEmisor == 200)$MEE = true;
			else echo "No se pudo enviar el mensaje";
			

			$respuestaEnviarMensajeReceptor = Mensajes::EnviarMensaje($NameTableReceptor,$emisor,$id_user_emisor,$mensaje,2,$hora_del_mensaje);
			if($respuestaEnviarMensajeReceptor == 200) $MER = true;
			else echo "No se pudo enviar el mensaje";
			

			if($MEE && $MER){
				echo json_encode(array('resultado' => 'El mensaje fue enviado correctamente'));
				Mensajes::EnviarNotification($mensaje,$hora_del_mensaje,$token,$emisor,$receptor);
			}
		}else{
			echo json_encode(array('resultado' => 'El usuario no existe'));
		}

	}

?>