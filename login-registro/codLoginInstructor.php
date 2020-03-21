<?php

//Inicializar sesion

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){

	header("location:bienvenida.php");
	exit;
}

require_once "conexion.php";

$Correo = $Password = "";
$Correo_error = $Password_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["Correo"]))){

		$Correo_error = "Por favor,ingrese su correo";
	}else{
	  
	$Correo = trim($_POST["Correo"]);
	
	}
	
	if(empty(trim($_POST["Password"]))){

		$Password_error = "Verifique la contraseña";
	}else{
	  
	$Password = trim($_POST["Password"]);
	
	}
	
	
	
	//Validacion de datos
	
	if(empty($Correo_error) && empty($Password_error)){
	
	$sql= "SELECT id,Nombres,Apellidos,FechaNacimiento,Correo,Telefono,Profesion,Password FROM Prueba WHERE Correo = :Correo";

	if($stmt = mysqli_prepare($conexion,$sql)){

		myslqi_stmt_bind_param($stmt,"s",$param_Correo);

		$param_Correo=$Correo;

		if(mysqli_stmt_execute($stmt)){

			mysqli_stmt_store_result($stmt);
		}

		if(mysqli_stmt_num_rows($stmt) == 1){

			mysqli_stmt_bin_result($stmt,$id,$Nombres,$Apellidos,$FechaNacimiento,$Correo,$Telefono,$Profesion,$hashed_password);
			if(mysqli_stmt_fetch($stmt)){

				if(password_verify($password,$hashed_password)){
					session_start();

					//Alamacenamiento de datos en variables de sesion

					$_SESSION["loggedin"] = true;
					$_SESSION["id"] = $id;
					$_SESSION["Correo"] = $Correo;

					header("location: bienvenida.php");
				}else{
					$Password_error = "la contraseña es incorrecta";
				}

			}else{
				$Correo_error = "No se ha encontrado ninguna cuenta con ese correo";
			}
		}else{
				echo "Algo salio mal, intentalo mas tarde";
			}
	}

	
	}

	mysqli_close($conexion);
	
}

?>