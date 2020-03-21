<?php

define('DB_SERVER','localhost');
define('DB_USERNAME','makedeve_mike');
define('DB_PASSWORD','Proyectox1116');
define('DB_NAME','makedeve_fangus');


$conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conexion === false){
die("error en la conexion". mysqli_connect_error());
}

?>