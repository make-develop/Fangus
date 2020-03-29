<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
        
	<meta name = "author" content = "Make Develop">
	<meta name ="description" content ="Motivation!">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="./stylesregister.css">
    <link rel="stylesheet" href="./bootstrap-float-label.css"/>
    <link rel="stylesheet" href="./animatedbtn.css"/>

	<title>Registro Fangus</title>
</head>
<header>
    <a href="#"><img src="./image/fangus-logo.png" class="size-fangus"></a>
</header>
<body>
<div class="back">
<a href="#" ><span>
    <img src="./image/back.png" alt="estudiante" width="20px"/>
        Atras
</span>
            </a>
</div>
<div class="registro-container">
    <span><form method="post" action="server.php"
                 <?php include('errors.php'); ?>>
                     <p><span>Datos básicos</span></p>
                     <br>
                     <div class="div-input">
                        <span class="has-float-label">
                         <input required type="text" class="form-control" name="id" autocomplete="off" placeholder="Usuario" value="<?php echo $username; ?>"/>
                         <label for="id">Nombre completo</label>
                         </span>
                            </div>
                            <div class="div-input">
                            <span class="has-float-label">
                            <input required type="password" class="form-control" name="password"  autocomplete="off" placeholder="Password" value="<?php echo $password; ?>">
                         <label for="password">Password</label>
                         </span>
                        </div>
                                         <div class="div-tc">
                                            <label class="container">Acepto los 
                                                <a target="_blank" href="#">Términos de Servicio</a> y las
                                                <a target="blank" href="#">Políticas de Privacidad</a>
                                                    <input type="checkbox" name="tc">
                                                    <span class="checkmark"></span>
                                                    </label>
                                        </div>
                                      
                                        <div class="div-btn">
                                        <button type="submit"  name="reg_user" class="button">
                                            <span>Continuar</span>
                                        </button>
                                        </div>
                                </form>
                            </span>
</div>

    
</body>
</html>