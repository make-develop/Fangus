<?php
	
	require 'Database.php';

	class Token{
		function _construct(){
		}

		public static function ObtenerTodosLosUsuarios(){
			$consultar = "SELECT * FROM TokenE";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute();

			return  $resultado->fetchAll(PDO::FETCH_ASSOC);

			return $tabla;

		}

		public static function ObtenerDatosPorId($id){
			$consultar = "SELECT id,token FROM TokenE WHERE id = ?";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute(array($id));

			$tabla = $resultado->fetch(PDO::FETCH_ASSOC);

			return $tabla;

		}

		public static function InsertarNuevoDato($id,$password){
			$consultar = "INSERT INTO TokenE(id,token) VALUES(?,?)";
			try{
				$resultado = Database::getInstance()->getDb()->prepare($consultar);
				return $resultado->execute(array($id,$password));
			}catch(PDOException $e){
				return false;
			}
		}

		public static function ActualizarDatos($id,$password){
			if(self::ObtenerDatosPorId($id)){
				$consultar = "UPDATE TokenE SET token=? WHERE id=?";
				$resultado = Database::getInstance()->getDb()->prepare($consultar);
				return $resultado->execute(array($password,$id));
			}else {
				return false;
			}
		}

	}

?>