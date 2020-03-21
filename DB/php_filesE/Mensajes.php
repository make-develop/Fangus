<?php
	require 'Database.php';

	class Mensajes{
		function __construct(){}

		public static function EnviarMensaje($TableName,$user,$code_mensaje, $mensaje,$tipo_mensaje,$hora_del_mensaje){
			try{
				$consultar = "INSERT INTO $TableName (user,code_mensaje,mensaje,tipo_mensaje,hora_del_mensaje) VALUES(?,?,?,?,?)";
				$respuesta = Database::getInstance()->getDb()->prepare($consultar);
				$respuesta->execute(array($user,$code_mensaje,$mensaje,$tipo_mensaje,$hora_del_mensaje));
				return 200;
			}catch(PDOException $e){
				return -1;
			}
		}

		public static function solicitarMensajesUsuario($nameTable,$receptor){
			try{
				$consultar = "SELECT * FROM $nameTable WHERE user = ?";
				$resultado = Database::getInstance()->getDb()->prepare($consultar);
				$resultado->execute(array($receptor));
				$tabla = $resultado->fetchAll(PDO::FETCH_ASSOC);
				return $tabla;
			}catch(PDOException $e){
				return false;
			}
		}

		public static function getTokenUser($id){
			$consultar = "SELECT id,token FROM Token WHERE id = ?";
			$resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id));
			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);
			return $tabla;
		}

		public static function EnviarNotification($Mensaje,$hora,$token,$emisor_del_mensaje,$receptor_del_mensaje){
			ignore_user_abort();
			ob_start();

			$url = 'https://fcm.googleapis.com/fcm/send';

			$fields = array('to' => $token,
			'data' => array('type' => 'mensaje','mensaje' => $Mensaje,'hora' => $hora,'cabezera' => $emisor_del_mensaje.' te envio un nuevo mensaje','cuerpo' => $Mensaje,'receptor'=> $receptor_del_mensaje,
				'emisor' =>$emisor_del_mensaje));

			define('GOOGLE_API_KEY', 'AIzaSyA-8lHT0QXNkPa_cnkDZrpJ0_IzyklNTBI');

			$headers = array(
			        'Authorization:key='.GOOGLE_API_KEY,
			        'Content-Type: application/json'
			);      

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

			$result = curl_exec($ch);
			if($result === false)
			  die('Curl failed ' . curl_error());
			curl_close($ch);
			return $result;
		}

	}

?>