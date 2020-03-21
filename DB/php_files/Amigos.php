<?php

	require 'Database.php';

	class Amigos{
			function __construct(){}

		public static function ObtenerTodosLosUsuarios($nameTable){
			$consultar = "SELECT $nameTable.id, $nameTable.estado, $nameTable.fecha_amigos,
			DatosPersonalesE.nombre,DatosPersonalesE.apellidos 
			FROM $nameTable,DatosPersonalesE
			WHERE $nameTable.id = DatosPersonalesE.id";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute();
			return  $resultado->fetchAll(PDO::FETCH_ASSOC);
			return $tabla;

		}
	}
?>
