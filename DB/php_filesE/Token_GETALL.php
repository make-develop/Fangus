<?php
	require 'Token.php';

	if($_SERVER['REQUEST_METHOD']=='GET'){
		try{
			$Respuesta = Token::ObtenerTodosLosUsuarios();
			echo json_encode($Respuesta);
		}catch(PDOException $e){
			echo "Ocurrio un error, intentelo mas tarde";
		}
	}

?>