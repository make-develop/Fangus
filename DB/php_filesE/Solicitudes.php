<?php
	require 'Database.php';

	class Solicitudes{
		function __construct(){}

		public static function CreateTable($NameTable){
			try{
				$consultar = "CREATE TABLE $NameTable (
					id VARCHAR (50) PRIMARY KEY,
				 	estado VARCHAR(10) NOT NULL,
				  	fecha_amigos VARCHAR(50) NOT NULL)";
				$respuesta = Database::getInstance()->getDb()->prepare($consultar);
				$respuesta -> execute(array());
				return 200;
			}catch(PDOException $e){
				return -1;
			}
		}

		//id
		//estado de nuestro amigo
		//1-AMIGO - ELIMINAR 
		//2-EVIADO
		//3-RECIBIDO
		//4-AMGIO
		//HORA EN QUE FUERON AMIGOS

		public static function obtenerDatosUsuario($id){
			$consultar = "SELECT nombre,apellidos FROM DatosPersonales WHERE id = ?";
			$resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id));
			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);
			return $tabla;
		}

		public static function obtenerUltimomMensaje($id,$receptor){
			$nameTableEmisor = "Mensajes_" . $id;
			$consultar = "SELECT * FROM $nameTableEmisor where id = (select max(id) FROM $nameTableEmisor M2 where M2.user = ?)";
			$resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($receptor));
			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);
			return $tabla;
		}

		public static function EnviarSolicitud($TableName, $id, $estado,$fecha_amigos){
			try{
				$consultar = "INSERT INTO $TableName (id,estado,fecha_amigos) VALUES(?,?,?)";
				$respuesta = Database::getInstance()->getDb()->prepare($consultar);
				$respuesta->execute(array($id,$estado,$fecha_amigos));
				return 200;
			}catch(PDOException $e){
				return -1;
			}
		}

		public static function ActualizarDatos($TableName,$id,$estado,$fecha_amigos,$estado_var){
			try{
				$consultar = "UPDATE $TableName SET estado=?,fecha_amigos=? WHERE id=? AND estado=?";
				$resultado = Database::getInstance()->getDb()->prepare($consultar);
				$resultado->execute(array($estado,$fecha_amigos,$id,$estado_var));
				return 200;
			}catch(PDOException $e){
				return -1;
			}
		}

		public static function EliminarSolicitud($TableName,$id){
			if(self::verificarSiExisteUsuario($TableName,$id)){
				$consultar = "DELETE FROM $TableName WHERE id=?";
				$resultado = Database::getInstance()->getDb()->prepare($consultar);
				$resultado->execute(array($id));
				return 200;
			}else{
				return -1;
			}
			
		}

		public static function verificarSiExisteUsuario($TableName,$id){
			$consultar = "SELECT * FROM $TableName WHERE id = ?";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return $tabla;
		}

		public static function getTokenUser($id){
			$consultar = "SELECT id,token FROM Token WHERE id = ?";
			$resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute(array($id));
			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);
			return $tabla;
		}

		public static function EnviarNotification($token,$arrayDatos){
			ignore_user_abort();
			ob_start();

			$url = 'https://fcm.googleapis.com/fcm/send';

			$fields = array('to' => $token,
			'data' => $arrayDatos);

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