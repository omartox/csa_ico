<?php
  require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos

  // escaping, additionally removing everything that could be (html/javascript-) code
  $usuario = mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
  $contrasena = mysqli_real_escape_string($con,(strip_tags($_POST["contrasena"],ENT_QUOTES)));
  $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
  $apellidos = mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
  $telefono = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
  $rol = mysqli_real_escape_string($con,(strip_tags($_POST["rol"],ENT_QUOTES)));


  // REGISTER data into database
  $sql = "INSERT INTO Usuarios(usuario, contrasena, nombre, apellidos, telefono, rol) VALUES ('$usuario','$contrasena','$nombre','$apellidos','$telefono','$rol')";
  $query = mysqli_query($con,$sql);
  // if product has been added successfully
  if ($query) {
        $messages[] = "El producto ha sido guardado con éxito.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
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