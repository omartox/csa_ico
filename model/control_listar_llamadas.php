<?php
	session_start();
	require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
	if(date("w")==0)
		$semana = date("W")+1;
	else
		$semana = date("W");
	
	
	
	?>

<style>

@media only screen and (max-width: 800px) {
	
	/* Force table to not be like tables anymore */
	#no-more-tables table, 
	#no-more-tables thead, 
	#no-more-tables tbody, 
	#no-more-tables th, 
	#no-more-tables td, 
	#no-more-tables tr { 
		display: block; 
	}
 
	/* Hide table headers (but not display: none;, for accessibility) */
	#no-more-tables thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
 
	#no-more-tables tr { border: 1px solid #ccc; }
 
	#no-more-tables td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 32%; 
		white-space: normal;
		
	}
 
	#no-more-tables td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		text-align:left;
		font-weight: bold;
	}
 
	/*
	Label the data
	*/
	#no-more-tables td:before { content: attr(data-title); }
}


	
.size{
  width: 100%;
  white-space: normal !important;
}
</style>
		<!-- Usuarios Alumnos Activos -->
        <div class="box box-success box-solid">
            <div class="box-header text-center">
              <h2 class="box-title"> <b>Semana <?php echo $semana; ?></b></h2>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body  no-padding">
              <table id="no-more-tables"class="table table-hover table-condensed table-striped">
			  <thead role="rowgroup">
					<tr role="row">
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
						<th style="width:50px" class='text-center' role="columnheader">Profesor</th>
						<?php } ?>
                        <th style="width:100px" class='text-center'>Horario</th>
						<th style="width:40px" class='text-center'>Cred.</th>
						<th style="width:50px" class='text-center'>Nombre </th>
						<th style="width:80px" class='text-center'>Apellidos </th>
						<th style="width:50px" class='text-center'>Telefono</th>
						<th style="width:216px" class='text-center'>Resp. Profesor</th>
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
						<th style="width:216px" class='text-center'>Resp. Secretaria</th>
						<?php } ?>
						<th style="width:30px" class='text-center'>Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$campos = "id_llamada, Llamadas.usuario, Usuarios.nombre as nombre_p , Usuarios.apellidos as apellidos_p, Llamadas.credencial, Alumnos.nombre as nombre_a, Alumnos.apellidos as apellidos_a, Alumnos.telefono as telefono_a, horario, semana, fecha, respuesta_1, respuesta_2";
						$tabla = "Llamadas INNER JOIN Usuarios on Llamadas.usuario = Usuarios.usuario INNER JOIN Alumnos on Llamadas.credencial = Alumnos.credencial INNER JOIN Horario on Horario.id_horario = Alumnos.id_horario";
						if($_SESSION['u_rol'] != 'Profesor'){
							$sWhere= "WHERE semana = $semana ORDER BY Usuarios.nombre , Alumnos.id_horario ASC";
						}else{
							$usu = $_SESSION['u_usuario'];
							$sWhere= "WHERE semana = $semana AND Llamadas.usuario = '$usu' ORDER BY Usuarios.nombre , Alumnos.id_horario ASC";
						}
						$query = mysqli_query($con,"SELECT $campos FROM  $tabla $sWhere");
						
						//loop through fetched data
						
						while($row = mysqli_fetch_array($query)){	
							$query_idllamada=$row['id_llamada'];
							$query_usuario=$row['usuario'];
							$query_nombre_p=$row['nombre_p'];
							$query_credencial=$row['credencial'];
							$query_nombre_a=$row['nombre_a'];
							$query_apellidos_a=$row['apellidos_a'];
							$query_telefono_a=$row['telefono_a'];
							$query_horario=$row['horario'];
							$query_respuesta_1=$row['respuesta_1'];
							$query_respuesta_2=$row['respuesta_2'];
							
						?>	
						<tr>
							<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
							<td data-title="Profesor" class='text-justify' ><?php echo $query_nombre_p;?></td>
							<?php } ?>
							<td data-title="Horario" class='text-justify' ><?php echo $query_horario;?></td>
                            
							<td data-title="Credencial" class='text-justify' ><?php echo $query_credencial;?></td>
							<td data-title="Nombre" class='text-justify'><?php echo $query_nombre_a;?></td>
							<td data-title="Apellidos" class='text-justify' ><?php echo $query_apellidos_a;?></td>
							<td data-title="Telefono" class='text-justify' ><?php echo $query_telefono_a;?></td>
							<td data-title="Resp. Prof." ><div class="size text-justify"><?php if ($query_respuesta_1 != ""){ echo $query_respuesta_1;}else{echo "<p class=text-muted><em>Sin respuesta</em></p>";}?></div></td>
                            <?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
							<td data-title="Resp. Secr." ><div class="size text-justify"><?php if ($query_respuesta_2 != ""){ echo $query_respuesta_2;}else{echo "<p class=text-muted><em>Sin respuesta</em></p>";}?></div></td>
							<?php } ?>
							<td data-title="Acciones" class='text-center'>
								<a class="btn btn-warning btn-xs" href="#"  data-target="#editLlamada" class="edit" data-toggle="modal" data-idllamada="<?php echo $query_idllamada;?>" data-alumno="<?php echo $query_nombre_a;?> <?php echo $query_apellidos_a;?>" ><i class="fa fa-fw fa-edit" data-toggle="tooltip" title="Editar" ></i></a>
								<a class="btn btn-danger btn-xs" href="#deleteLlamada" class="delete" data-toggle="modal" data-idllamada="<?php echo $query_idllamada;?>"><i class="fa fa-fw fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
                    		</td>
						</tr>
						<?php }?>
				</tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
			<!--
			<div class="overlay carga_alumno">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			-->
        </div>
        <!-- /.box -->
		
		<!-- LLAMADAS SEMANA PASADA -->
		<div class="box box-primary box-solid">
		<div class="box-header text-center">
              <h2 class="box-title"> <b>Semana <?php echo $semana-1; ?></b></h2>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body  no-padding">
              <table id="no-more-tables"class="table table-hover table-condensed table-striped">
			  <thead role="rowgroup">
					<tr role="row">
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
						<th style="width:50px" class='text-center' role="columnheader">Profesor</th>
						<?php } ?>
                        <th style="width:100px" class='text-center'>Horario</th>
						<th style="width:40px" class='text-center'>Cred.</th>
						<th style="width:50px" class='text-center'>Nombre </th>
						<th style="width:80px" class='text-center'>Apellidos </th>
						<th style="width:50px" class='text-center'>Telefono</th>
						<th style="width:216px" class='text-center'>Resp. Profesor</th>
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
						<th style="width:216px" class='text-center'>Resp. Secretaria</th>
						<?php } ?>
						<th style="width:30px" class='text-center'>Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$campos = "id_llamada, Llamadas.usuario, Usuarios.nombre as nombre_p , Usuarios.apellidos as apellidos_p, Llamadas.credencial, Alumnos.nombre as nombre_a, Alumnos.apellidos as apellidos_a, Alumnos.telefono as telefono_a, horario, semana, fecha, respuesta_1, respuesta_2";
						$tabla = "Llamadas INNER JOIN Usuarios on Llamadas.usuario = Usuarios.usuario INNER JOIN Alumnos on Llamadas.credencial = Alumnos.credencial INNER JOIN Horario on Horario.id_horario = Alumnos.id_horario";
						if($_SESSION['u_rol'] != 'Profesor'){
							$sWhere2= "where semana = $semana-1 ORDER BY semana DESC, Usuarios.nombre ASC";
						}else{
							$usu = $_SESSION['u_usuario'];
							$sWhere2= "where semana = $semana-1 AND Llamadas.usuario= '$usu' ORDER BY semana DESC, Usuarios.nombre DESC";
						}
						$query2 = mysqli_query($con,"SELECT $campos FROM  $tabla $sWhere2");
						//loop through fetched data
						
						while($row = mysqli_fetch_array($query2)){	
							$query_idllamada=$row['id_llamada'];
							$query_usuario=$row['usuario'];
							$query_nombre_p=$row['nombre_p'];
							$query_credencial=$row['credencial'];
							$query_nombre_a=$row['nombre_a'];
							$query_apellidos_a=$row['apellidos_a'];
							$query_telefono_a=$row['telefono_a'];
							$query_horario=$row['horario'];
							$query_respuesta_1=$row['respuesta_1'];
							$query_respuesta_2=$row['respuesta_2'];
							$query_semana= $row['semana'];
							
						?>	
						<tr>
							<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
							<td data-title="Prosefor" class='text-justify'><?php echo $query_nombre_p;?></td>
							<?php } ?>
							<td data-title="Horario" class='text-justify' ><?php echo $query_horario;?></td>
							<td data-title="Credencial" class='text-justify' ><?php echo $query_credencial;?></td>
							<td data-title="Nombre" class='text-justify'><?php echo $query_nombre_a;?></td>
							<td data-title="Apellidos" class='text-justify' ><?php echo $query_apellidos_a;?></td>
							<td data-title="Telefono" class='text-justify' ><?php echo $query_telefono_a;?></td>
							
                            <td data-title="Resp. Prof." ><div class="size text-justify"><?php if ($query_respuesta_1 != ""){ echo $query_respuesta_1;}else{echo "<p class=text-muted><em>Sin respuesta</em></p>";}?></div></td>
                            <?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
							<td data-title="Resp. Secr." ><div class="size text-justify"><?php if ($query_respuesta_2 != ""){ echo $query_respuesta_2;}else{echo "<p class=text-muted><em>Sin respuesta</em></p>";}?></div></td>
							<td data-title="Acciones" class='text-center'>
								<a class="btn btn-warning btn-xs" href="#"  data-target="#editLlamada" class="edit" data-toggle="modal" data-idllamada="<?php echo $query_idllamada;?>" data-alumno="<?php echo $query_nombre_a;?> <?php echo $query_apellidos_a;?>" ><i class="fa fa-fw fa-edit" data-toggle="tooltip" title="Editar" ></i></a>
							</td>
							<?php } ?>

						</tr>
						<?php }?>
				</tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
			<!--
			<div class="overlay carga_alumno">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			-->
        </div>
        <!-- /.box -->
		
	
		<!-- Usuarios Alumnos baja -->
		<div class="box box-default">
		<div class="box-header text-center">
              <h2 class="box-title"> <b>Semanas anteriores</b></h2>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body  no-padding">
              <table id="no-more-tables"class="table table-hover table-condensed table-striped">
			  <thead role="rowgroup">
					<tr role="row">
						<th>Sem.</th>
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
						<th>Profesor</th>
						<?php } ?>
						<th role="columnheader" class='text-center'>Credencial</th>
						<th>Nombre </th>
						<th>Apellidos </th>
						<th class='text-center'>Telefono</th>
                        <th>Horario</th>
						<th style="width:200px">Resp. Profesor</th>
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
						<th style="width:200px">Resp. Secretaria</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$campos = "id_llamada, Llamadas.usuario, Usuarios.nombre as nombre_p , Usuarios.apellidos as apellidos_p, Llamadas.credencial, Alumnos.nombre as nombre_a, Alumnos.apellidos as apellidos_a, Alumnos.telefono as telefono_a, horario, semana, fecha, respuesta_1, respuesta_2";
						$tabla = "Llamadas INNER JOIN Usuarios on Llamadas.usuario = Usuarios.usuario INNER JOIN Alumnos on Llamadas.credencial = Alumnos.credencial INNER JOIN Horario on Horario.id_horario = Alumnos.id_horario";
						if($_SESSION['u_rol'] != 'Profesor'){
							$sWhere2= "where semana < $semana-1 ORDER BY semana DESC, Usuarios.nombre ASC";
						}else{
							$usu = $_SESSION['u_usuario'];
							$sWhere2= "where semana < $semana-1 AND Llamadas.usuario= '$usu' ORDER BY semana DESC, Usuarios.nombre DESC";
						}
						$query2 = mysqli_query($con,"SELECT $campos FROM  $tabla $sWhere2");
						//loop through fetched data
						
						while($row = mysqli_fetch_array($query2)){	
							$query_idllamada=$row['id_llamada'];
							$query_usuario=$row['usuario'];
							$query_nombre_p=$row['nombre_p'];
							$query_credencial=$row['credencial'];
							$query_nombre_a=$row['nombre_a'];
							$query_apellidos_a=$row['apellidos_a'];
							$query_telefono_a=$row['telefono_a'];
							$query_horario=$row['horario'];
							$query_respuesta_1=$row['respuesta_1'];
							$query_respuesta_2=$row['respuesta_2'];
							$query_semana= $row['semana'];
							
						?>	
						<tr>
							<td data-title="Semana" class='text-justify'><?php echo $query_semana;?></td>
							<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
							<td data-title="Prosefor" class='text-justify'><?php echo $query_nombre_p;?></td>
							<?php } ?>
							<td data-title="Credencial" class='text-justify' ><?php echo $query_credencial;?></td>
							<td data-title="Nombre" class='text-justify'><?php echo $query_nombre_a;?></td>
							<td data-title="Apellidos" class='text-justify' ><?php echo $query_apellidos_a;?></td>
							<td data-title="Telefono" class='text-justify' ><?php echo $query_telefono_a;?></td>
							<td data-title="Horario" class='text-justify' ><?php echo $query_horario;?></td>
                            <td data-title="Resp. Prof." ><div class="size text-justify"><?php if ($query_respuesta_1 != ""){ echo $query_respuesta_1;}else{echo "<p class=text-muted><em>Sin respuesta</em></p>";}?></div></td>
                            <?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
							<td data-title="Resp. Secr." ><div class="size text-justify"><?php if ($query_respuesta_2 != ""){ echo $query_respuesta_2;}else{echo "<p class=text-muted><em>Sin respuesta</em></p>";}?></div></td>
							<?php } ?>
						</tr>
						<?php }?>
				</tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
			<!--
			<div class="overlay carga_alumno">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			-->
        </div>
        <!-- /.box -->
		