<?php
	session_start();
	require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
	$campos = "Alumnos.status,Alumnos.usuario,Alumnos.credencial, Alumnos.nombre, Alumnos.apellidos, Alumnos.telefono, Alumnos.id_horario, Horario.id_horario, Horario.horario,  Usuarios.nombre as profe";
	if($_SESSION['u_rol'] != 'Profesor'){
		$tabla = "Alumnos INNER JOIN Horario ON Alumnos.id_horario = Horario.id_horario left JOIN Usuarios on Alumnos.usuario = Usuarios.usuario";
		$sWhere= "status = 'Activo' ORDER BY Alumnos.usuario DESC, Alumnos.id_horario ASC";
		$sWhere2= "status = 'Baja' ORDER BY Alumnos.usuario DESC, Alumnos.id_horario ASC ";
	}else{
		$usu = $_SESSION['u_usuario'];
		$tabla = "Alumnos INNER JOIN Horario ON Alumnos.id_horario = Horario.id_horario left JOIN Usuarios on Alumnos.usuario = Usuarios.usuario";
		$sWhere= "status = 'Activo' and Alumnos.usuario = '$usu' ORDER BY Alumnos.id_horario ASC";
		$sWhere2= "status = 'Baja' and Alumnos.usuario = '$usu' ORDER BY Alumnos.id_horario ASC";
	}
	
	
	$query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
	$query2 = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere2");
	//loop through fetched data
	
	
	?>


		<!-- Usuarios Alumnos Activos -->
        <div class="box box-success box-solid">
            <div class="box-header">
              <h3 class="box-title">Listado Alumnos Activos</h3>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
			  <thead>
					<tr>
						<th class='text-center'>Credencial</th>
						<th>Nombre </th>
						<th>Apellidos </th>
						<th class='text-center'>Telefono</th>
                        <th>Horario</th>
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
                        <th>Profesor </th>
						<?php } ?>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$query_credencial=$row['credencial'];
							$query_nombre=$row['nombre'];
							$query_apellidos=$row['apellidos'];
							$query_telefono=$row['telefono'];
							$query_horario=$row['horario'];
							$query_id_horario=$row['id_horario'];
							$query_status=$row['status'];
							$query_usuario=$row['usuario'];
							if($_SESSION['u_rol'] != 'Profesor'){ 
							$query_nombrep=$row['profe'];
							}
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $query_credencial;?></td>
							<td ><?php echo $query_nombre;?></td>
							<td ><?php echo $query_apellidos;?></td>
							<td class='text-center' ><?php echo $query_telefono;?></td>
                            <td ><?php echo $query_horario;?></td>
							<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
                            <td ><?php echo $query_nombrep;?></td>
							<?php } ?>
							<td>
								<a class="btn btn-warning btn-xs" href="#"  data-target="#editAlumnoModal" class="edit" data-toggle="modal" data-credencial='<?php echo $query_credencial;?>' data-nombre="<?php echo $query_nombre; ?>" data-apellidos="<?php echo $query_apellidos; ?>" data-telefono="<?php echo $query_telefono; ?>" data-idhorario="<?php echo $query_id_horario; ?>" data-status="<?php echo $query_status; ?>" data-usuario="<?php echo $query_usuario; ?>"><i class="fa fa-fw fa-edit" data-toggle="tooltip" title="Editar" ></i></a>
								&nbsp;<a class="btn btn-danger btn-xs" href="#deleteAlumnoModal" class="delete" data-toggle="modal" data-credencial="<?php echo $query_credencial;?>"><i class="fa fa-fw fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
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

	
		<!-- Usuarios Alumnos baja -->
		<div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Listado Alumnos Bajas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
			  <thead>
					<tr>
						<th class='text-center'>Credencial</th>
						<th>Nombre </th>
						<th>Apellidos </th>
						<th class='text-center'>Telefono</th>
                        <th>Horario</th>
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
                        <th>Profesor </th>
						<?php } ?>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query2)){	
							$query_credencial=$row['credencial'];
							$query_nombre=$row['nombre'];
							$query_apellidos=$row['apellidos'];
							$query_telefono=$row['telefono'];
							$query_horario=$row['horario'];
							$query_id_horario=$row['id_horario'];
							$query_status=$row['status'];
							$query_usuario=$row['usuario'];
							if($_SESSION['u_rol'] != 'Profesor'){ 
							$query_nombrep=$row['profe'];
							}
							$finales++;
						?>	
						<tr class="<?php echo $text_class;?>">
							<td class='text-center'><?php echo $query_credencial;?></td>
							<td ><?php echo $query_nombre;?></td>
							<td ><?php echo $query_apellidos;?></td>
							<td class='text-center' ><?php echo $query_telefono;?></td>
                            <td ><?php echo $query_horario;?></td>
							<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
                            <td ><?php echo $query_nombrep;?></td>
							<?php } ?>
							<td>
								<a class="btn btn-warning btn-xs" href="#"  data-target="#editAlumnoModal" class="edit" data-toggle="modal" data-credencial='<?php echo $query_credencial;?>' data-nombre="<?php echo $query_nombre; ?>" data-apellidos="<?php echo $query_apellidos; ?>" data-telefono="<?php echo $query_telefono; ?>" data-idhorario="<?php echo $query_id_horario; ?>" data-status="<?php echo $query_status; ?>" data-usuario="<?php echo $query_usuario; ?>"><i class="fa fa-fw fa-edit" data-toggle="tooltip" title="Editar" ></i></a>
								&nbsp;<a class="btn btn-danger btn-xs" href="#deleteAlumnoModal" class="delete" data-toggle="modal" data-credencial="<?php echo $query_credencial;?>"><i class="fa fa-fw fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
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
		