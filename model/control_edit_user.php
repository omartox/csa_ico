<?php
  require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos

  // escaping, additionally removing everything that could be (html/javascript-) code
  $usuario = mysqli_real_escape_string($con,(strip_tags($_POST["edit_usuario"],ENT_QUOTES)));
  $contrasena = mysqli_real_escape_string($con,(strip_tags($_POST["edit_contrasena"],ENT_QUOTES)));
  $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["edit_nombre"],ENT_QUOTES)));
  $apellidos = mysqli_real_escape_string($con,(strip_tags($_POST["edit_apellidos"],ENT_QUOTES)));
  $telefono = mysqli_real_escape_string($con,(strip_tags($_POST["edit_telefono"],ENT_QUOTES)));
  $rol = mysqli_real_escape_string($con,(strip_tags($_POST["edit_rol"],ENT_QUOTES)));


  // REGISTER data into database
  $sql = "UPDATE Usuarios SET contrasena='".$contrasena."', nombre='".$nombre."', apellidos='".$apellidos."', telefono='".$telefono."',  rol='".$rol."' WHERE usuario='".$usuario."' ";

  $query = mysqli_query($con,$sql);
  // if product has been added successfully
  if ($query) {
        $messages[] = "El producto ha sido actualizado con éxito.";
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