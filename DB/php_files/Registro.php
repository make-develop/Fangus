<?php
	
	require 'Database.php';

	class Registro{
		function _construct(){
		}

		public static function InsertarNuevoDato($id,$nombre,$apellido,$fecha,$correo,$telefono,$genero){
			$consultar = "INSERT INTO DatosPersonales(id,nombre,apellidos,fecha_de_nacimiento,correo,telefono,genero) VALUES(?,?,?,?,?,?,?)";
			try{
				$resultado = Database::getInstance()->getDb()->prepare($consultar);
				return $resultado->execute(array($id,$nombre,$apellido,$fecha,$correo,$telefono,$genero));
			}catch(PDOException $e){
				return false;
			}
		}

		public static function InsertarEnTablaLogin($id,$password){
			$consultar = "INSERT INTO Login(id,Password) VALUES(?,?)";
			try{
				$resultado = Database::getInstance()->getDb()->prepare($consultar);
				return $resultado->execute(array($id,$password));
			}catch(PDOException $e){
				return false;
			}
		}

		public static function CreateTableMensajes($id){
			$NameTable = "Mensajes_" . $id;
			try{
				$consultar = "CREATE TABLE $NameTable (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					user VARCHAR(50) NOT NULL,
					code_mensaje VARCHAR(80) NOT NULL,
				 	mensaje VARCHAR(500) NOT NULL,
				  	tipo_mensaje VARCHAR(10) NOT NULL,
				  	hora_del_mensaje VARCHAR(50) NOT NULL )";
				$respuesta = Database::getInstance()->getDb()->prepare($consultar);
				$respuesta -> execute(array());
				return 200;
			}catch(PDOException $e){
				return -1;
			}
		}

		public static function CreateTableAmigos($id){
			$NameTable = "Amigos_" . $id;
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

	}

?>