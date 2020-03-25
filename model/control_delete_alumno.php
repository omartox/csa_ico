<?php
  require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos

  // escaping, additionally removing everything that could be (html/javascript-) code
  $credencial = mysqli_real_escape_string($con,(strip_tags($_POST["delete_credencial"],ENT_QUOTES)));
  
  // REGISTER data into database
  $sql = "DELETE FROM Alumnos WHERE credencial='$credencial'";
  $query = mysqli_query($con,$sql);
  // if product has been added successfully
  if ($query) {
        $messages[] = "El Alumno ha sido eliminado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la eliminación falló. Por favor, regrese y vuelva a intentarlo.";
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