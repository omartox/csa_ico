<?php
	require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
	
    $profe = mysqli_real_escape_string($con,(strip_tags($_POST["profe"],ENT_QUOTES)));
    $horario = intval($_POST["horario"]);
              	$campos = "credencial, nombre, apellidos";
              	$tabla = "Alumnos";
				$sWhere="usuario = '$profe' and id_horario = '$horario'";
				$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tabla where $sWhere ");
				if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
				else {echo mysqli_error($con);}
				if ($numrows>0){
                    ?>
                    <ul class="todo-list"> 
                    <?php
					$query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
					while($row = mysqli_fetch_array($query)){ 
						$crede = $row['credencial'];
						if(date("w")==0)
							$sem = date("W")+1;
						else
							$sem = date("W");
						$proceso = mysqli_query($con,"SELECT id_llamada FROM `Llamadas` WHERE semana ='$sem' and credencial = '$crede'");
						if($resultado = mysqli_fetch_array($proceso)){
						?>
							<li class="done">
								<input type="checkbox" checked disabled>
								<span class="text"><?php echo $row['nombre'];?> <?php echo $row['apellidos'];?></span>
							</li>
						<?php }else{ ?>
							<li>
								<input type="checkbox" name="array_alumnos[]" value="<?php echo $row['credencial'];?>">
								<span class="text"><?php echo $row['nombre'];?> <?php echo $row['apellidos'];?></span>
							</li>
						<?php } ?>
				<?php 
					} ?>
                    </ul>
                    <br>
                    <a class="btn btn-default" onclick='ocultar_boxLlamada();'>Cancelar</a>
                    <button type="submit" class="btn btn-info pull-right">Guardar</button>
                    <?php
				}else{?>
					<h4 class="text-center"><b>Sin resultados</b></h4>
                    <a class="btn btn-default" onclick='ocultar_boxLlamada();'>Cancelar</a>
				<?php
					}
				?>
