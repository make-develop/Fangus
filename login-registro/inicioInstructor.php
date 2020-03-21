<?php

require "codLoginInstructor.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name = "author" content = "Make Develop">
	 <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Login-Fangus</title>
<link rel="stylesheet" href="css/inicioInstructor.css">
</head>
<body>

	<div class="contenedor-total">	
    
            <div class="contenedor-formulario">
     	     	<img src="image/logo.png" class="logo"> 
                 <h1 class="titulo">Iniciar Sesión</h1>

                 <form ation="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> " method="post">
                 	<label for="Correo">Email</label>
                 	<input type="text" id="Correo" name="Correo">
                    <span class="mensaje-error" ><?php echo $Correo_error; ?></span>
                    
                 	<label for="Password">Contraseña</label>
                 	<input type="password" maxlength="20" id="Password" name="Password">
                    <span class="mensaje-error"><?php echo $Password_error; ?></span>


                 	<input type="submit" value="Iniciar">

                 </form>

                 <span class="texto-footer">¿Aún no te has registrado? <a href="registroInstructor.php">Registrate</a>
                 </span>
            </div>

                  <div class="contenedor-texto">
            	     <div class="capa"></div>
            	     <h1 class="detalles-titulo"><div>¡Bienvenido a Fangus!</h1> 
            	     <p class="detalles-texto">Nos alegra tenerte de regreso, esperamos disfutes y te diviertas aprendiendo con nosotros</p>
                  </div>

	</div>
	
</body>
</html>