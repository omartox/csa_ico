<?php
    session_start();
  require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos

  // escaping, additionally removing everything that could be (html/javascript-) code
  $id_llamada = mysqli_real_escape_string($con,(strip_tags($_POST["id_llamada"],ENT_QUOTES)));
  $resp= $_POST["respuesta_2"];
  $resp = strtolower($resp);
  $respuesta = ucfirst($resp);
  if($_SESSION['u_rol'] != 'Profesor'){
    // REGISTER data into database
    $sql = "UPDATE Llamadas SET respuesta_2='".$respuesta."' WHERE id_llamada='".$id_llamada."' ";
  }else{
    // REGISTER data into database
    $sql = "UPDATE Llamadas SET respuesta_1='".$respuesta."' WHERE id_llamada='".$id_llamada."' ";
  }
  
  $query = mysqli_query($con,$sql);
  // if product has been added successfully
  if ($query) {
        $messages[] = "La respuesta ha sido actualizado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
    }
    if (isset($errors)){
			
        ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> 
                <?php
                    foreach ($errors as $error) {
                            echo $error;
                        }
                    ?>
        </div>
        <?php 
        }/*
        if (isset($messages)){
            
            ?>
            <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>¡Bien hecho!</strong>
                    <?php
                        foreach ($messages as $message) {
                                echo $message;
                            }
                        ?>
            </div>
            <?php
        }*/
?>			