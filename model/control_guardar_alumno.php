<?php
  require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos

  // escaping, additionally removing everything that could be (html/javascript-) code
  $credencial = mysqli_real_escape_string($con,(strip_tags($_POST["credencial"],ENT_QUOTES)));
  $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
  $apellidos = mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
  $telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
  $horario = intval($_POST["horario"]);
  $status = mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));
  $usuario = mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));


  // REGISTER data into database
  $sql = "INSERT INTO Alumnos(credencial, nombre, apellidos, telefono, id_horario, status, usuario) VALUES ('$credencial','$nombre','$apellidos','$telefono','$horario','$status','$usuario')";
  $query = mysqli_query($con,$sql);
  // if product has been added successfully
  if ($query) {
        $messages[] = "El alumno ha sido registrado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.,'$credencial','$nombre','$apellidos','$telefono','$horario','$status','$usuario'";
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
        }
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
        }
?>			