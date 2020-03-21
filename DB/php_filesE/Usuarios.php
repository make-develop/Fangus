<?php
	require 'Database.php';

	class Usuarios{
		function _construct(){
		}

		public static function ObtenerTodosLosUsuarios(){
			$consultar = "SELECT id,nombre FROM DatosPersonales WHERE id IN (SELECT id FROM Token)";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);

			$resultado->execute();

			return  $resultado->fetchAll(PDO::FETCH_ASSOC);

			return $tabla;

		}
	}

?>