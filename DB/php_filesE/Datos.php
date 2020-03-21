<?php

	require 'Database.php';

	class Datos{
			function __construct(){}

		public static function ObtenerTodoLosDatos($id){//paula
			$tableAmigos = "Amigos_".$id;//"Amigos_puala"
			$tableMensajes = "Mensajes_".$id;//"Mensajes_paula"
			$consultar = "SELECT D.id, D.nombre, D.apellidos, F.estado, F.fecha_amigos,M.mensaje , M.hora_del_mensaje,M.tipo_mensaje
							FROM DatosPersonales D
							LEFT JOIN $tableAmigos F ON F.id = D.id
							LEFT JOIN $tableMensajes M ON M.user = D.id AND M.id = (select max(M2.id) FROM $tableMensajes M2 where M2.user = M.user)";

			$resultado = Database::getInstance()->getDb()->prepare($consultar);
			$resultado->execute();
			return  $resultado->fetchAll(PDO::FETCH_ASSOC);
			return $tabla;

		}
	}
?>