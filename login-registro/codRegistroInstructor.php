<?php
    require_once "conexion.php";


    $name = $lastname=$dateb = $email = $profession =$tlf="";
    $Nombres_error = $Apellidos_error =$FechaNacimiento_error = $Correo_error= $Telefono_error=$Profesion_error="";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      
      if(empty(trim($_POST["name"]))){
        $Nombres_error="Por favor llene el campo";
      }
  
      if(empty(trim($_POST["lastname"]))){
        $Apellidos_error="Por favor llene el campo";
      }
      
      if(empty(trim($_POST["dateb"]))){
        $FechaNacimiento_error="Por favor llene el campo";
      }
      
      if(empty(trim($_POST["profession"]))){
        $Profesion_error="Por favor llene el campo";
      }
      
      if(empty(trim($_POST["email"]))){
        $Correo_error="Por favor llene el campo";
      }
    

      
       if(empty($Nombres_error) && empty($Apellidos_error) && empty($FechaNacimiento_error) && empty($Correo_error) && empty($Profesion_error) {
       

  $unique_id = uniqid('', true);



              $sql="INSERT INTO Instructor (unique_id, name,lastname,dateb,email,profession,tlf,) VALUES ('$_POST[name]','$_POST[lastname]','$_POST[dateb]','$_POST[email]','$_POST[profession]','$_POST[tlf]' )";

              if($stmt = mysqli_prepare($conexion,$sql)){
                mysqli_stmt_bind_param($stmt,"sssssss",$unique_id, $param_name, $param_lastname,$param_dateb,$param_email,$param_profession,$param_tlf);

                //PARAMETROS QUE VAMOS A ALMACENAR
    
                $param_name = $name;
                $param_lastname = $lastname;
                $param_dateb = $dateb;
                $param_email = $email;
                $param_profession = $profession;
                $param_tlf =$tlf;

              
                if(mysqli_stmt_execute($stmt)){
                  header("location:inicioInstructor.php");
                }
                else{
                  echo "Algo salio mal, intentalo nuevamente";
                }
              }
            }
      
            
  mysqli_close($conexion);

    }


?>