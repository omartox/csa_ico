<?php
require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
    $profe = $_POST['profe'];
    $horario= $_POST['horario'];
    $fecha = $_POST['fecha'];
    $semana = $_POST['semana'];
    $array_a = $_POST['array_alumnos'];
    $cadena = "INSERT INTO Llamadas (usuario,credencial,semana,fecha) VALUES ";
    for($i=0; $i< count($array_a); $i++){
        $cadena.="('$profe','$array_a[$i]','$semana','$fecha'),";
    }

    $sql = substr($cadena,0,-1);
    

    //echo json_encode(array('cadena'=> $sql));
    
   $query = mysqli_query($con,$sql);
  // if product has been added successfully
  if ($query) {
        $messages[] = "Llamadas agregadas al reporte!.";
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.,$sql";
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