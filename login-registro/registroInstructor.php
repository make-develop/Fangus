<?php

include "codRegistroInstructor.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name = "author" content = "Make Develop">
	 <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Registro-Fangus</title>
<link rel="stylesheet" href="css/registroInstructor.css">
</head>
<body>

	<div class="contenedor-total">	
    
            <div class="contenedor-formulario">
     	     	<img src="image/logo.png" class="logo"> 
                 <h1 class="titulo">Registro</h1>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form">
                    <label for="name">Nombres</label>
                    <input type="text" maxlength="60" name="name" id="name">
                    <span class="mensaje-error"><?php echo $Nombres_error; ?></span>

                    <label for="lastname">Apellidos</label>
                    <input type="text" maxlength="60" name="lastname" id="lastname">
                    <span class="mensaje-error"><?php echo $Apellidos_error; ?></span>

                  <label for="dateb">Fecha de Nacimiento</label>
                    <input type="date" name="dateb" id="dateb">
                     <span class="mensaje-error"><?php echo $FechaNamiento_error; ?></span>

                 	<label for="email">Email</label>
                 	<input type="email" maxlength="60" name="email" id="email">
                    <span class="mensaje-error"><?php echo $Correo_error; ?></span>

                    <label for="profession">Profesion</label>
                    <input type="text" placeholder="ejemplo: instructor de motores" maxlength="60" name="profession" id="profesion">
                    <span class="mensaje-error"><?php echo $Profesion_error; ?></span>
                    
                    <label for="tlf">Numero de Celular</label>
                    <input type="tel" min="0" maxlength="10"  name="tlf" id="tlf">
            

                    <div class="terminos">

                   <h5>Al registrarte, aceptas nuestros <b><a href="#"> Términos de Servicio</a></b> y <b> <a href="#"> Política de Privacidad</a></b></h5>

                   </div>
            
                    
                    

                 	<input type="submit" value="Registrarse">

                 </form>

                 <span class="texto-footer">¿Ya estás registrado? <a href="inicioInstructor.php">Iniciar Sesión</a>
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