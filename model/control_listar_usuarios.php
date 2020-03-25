<?php
	session_start();
	if(isset($_SESSION['u_usuario'])){
	require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
	$campos = "*";
    $tabla = "Usuarios";
	$sWhere= "rol = 'Profesor'";
	$sWhere2= "rol = 'Secretaria'";
	$query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
	$query2 = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere2");
	//loop through fetched data
	
	
	?>

<?php if($_SESSION['u_rol'] != 'Profesor' and $_SESSION['u_rol'] != 'Secretaria'){ 
	?>
	<!-- Usuarios Alumnos Activos -->
	<div class="box box-info box-solid">
            <div class="box-header">
              <h3 class="box-title">Listado Profesores</h3>
			  
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped ">
			  <thead>
					<tr>
						<th class='text-center'>Usuario</th>
						<th>Nombre </th>
						<th>Apellidos </th>
						<th class='text-center'>Telefono</th>
						
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
							$query_usu=$row['usuario'];
							$query_nombre=$row['nombre'];
							$query_apellidos=$row['apellidos'];
							$query_telefono=$row['telefono'];
							$query_rol=$row['rol'];
							$query_contrasena=$row['contrasena'];
							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $query_usu;?></td>
							<td ><?php echo $query_nombre;?></td>
							<td ><?php echo $query_apellidos;?></td>
							<td class='text-center' ><?php echo $query_telefono;?></td>
							<td>
								<a href="#"  data-target="#editUsuariosModal" class="edit btn btn-warning btn-xs" data-toggle="modal" data-usuario='<?php echo $query_usu;?>' data-nombre="<?php echo $query_nombre; ?>" data-apellidos="<?php echo $query_apellidos; ?>" data-telefono="<?php echo $query_telefono; ?>" data-rol="<?php echo $query_rol; ?>" data-contrasena="<?php echo $query_contrasena; ?>"><i class="fa fa-fw fa-edit" data-toggle="tooltip" title="Editar" ></i></a>
								&nbsp;<a href="#deleteUsuarioModal" class="delete btn btn-danger btn-xs" data-toggle="modal" data-usuario="<?php echo $query_usu;?>"><i class="fa fa-fw fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
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
		<div class="box box-primary box-solid">
            <div class="box-header">
              <h3 class="box-title">Listado Secretarias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
			  <thead>
					<tr>
						<th class='text-center'>Usuario</th>
						<th>Nombre </th>
						<th>Apellidos </th>
						<th class='text-center'>Telefono</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query2)){	
							$query_usu=$row['usuario'];
							$query_nombre=$row['nombre'];
							$query_apellidos=$row['apellidos'];
							$query_telefono=$row['telefono'];
							$query_rol=$row['rol'];
							$query_contrasena=$row['contrasena'];	
							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $query_usu;?></td>
							<td ><?php echo $query_nombre;?></td>
							<td ><?php echo $query_apellidos;?></td>
							<td class='text-center' ><?php echo $query_telefono;?></td>
							<td>
								<a href="#"  data-target="#editUsuariosModal" class="edit btn btn-warning btn-xs" data-toggle="modal" data-usuario='<?php echo $query_usu;?>' data-nombre="<?php echo $query_nombre; ?>" data-apellidos="<?php echo $query_apellidos; ?>" data-telefono="<?php echo $query_telefono; ?>" data-rol="<?php echo $query_rol; ?>" data-contrasena="<?php echo $query_contrasena; ?>"><i class="fa fa-fw fa-edit" data-toggle="tooltip" title="Editar" ></i></a>
								&nbsp;<a href="#deleteUsuarioModal" class="delete btn btn-danger btn-xs" data-toggle="modal" data-usuario="<?php echo $query_usu;?>"><i class="fa fa-fw fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
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
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado Administradores</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
			  <thead>
					<tr>
						<th class='text-center'>Usuario</th>
						<th>Nombre </th>
						<th>Apellidos </th>
						<th class='text-center'>Telefono</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$campos = "*";
						$tabla = "Usuarios";
						$sWhere= "rol = 'Admin'";
						
						$query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
						while($row = mysqli_fetch_array($query)){	
							$query_usu=$row['usuario'];
							$query_nombre=$row['nombre'];
							$query_apellidos=$row['apellidos'];
							$query_telefono=$row['telefono'];
							$query_rol=$row['rol'];
							$query_contrasena=$row['contrasena'];	
							$finales++;
						?>	
						<tr>
							<td class='text-center'><?php echo $query_usu;?></td>
							<td ><?php echo $query_nombre;?></td>
							<td ><?php echo $query_apellidos;?></td>
							<td class='text-center' ><?php echo $query_telefono;?></td>
							<td>
								<a href="#"  data-target="#editUsuariosModal" class="edit btn btn-warning btn-xs" data-toggle="modal" data-usuario='<?php echo $query_usu;?>' data-nombre="<?php echo $query_nombre; ?>" data-apellidos="<?php echo $query_apellidos; ?>" data-telefono="<?php echo $query_telefono; ?>" data-rol="<?php echo $query_rol; ?>" data-contrasena="<?php echo $query_contrasena; ?>"><i class="fa fa-fw fa-edit" data-toggle="tooltip" title="Editar" ></i></a>
								&nbsp;<a href="#deleteUsuarioModal" class="delete btn btn-danger btn-xs" data-toggle="modal" data-usuario="<?php echo $query_usu;?>"><i class="fa fa-fw fa-trash" data-toggle="tooltip" title="Eliminar"></i></a>
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

						<?php }else{?>
<h2> Usted que hace aqui? saquese </h2>
						<?php }?><?php }?>