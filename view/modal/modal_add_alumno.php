
<div id="addAlumnoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_alumno" id="add_alumno">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Alumno</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Credencial</label>
							<input type="tel" name="credencial"  id="credencial" class="form-control" required>
							
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Apellidos</label>
							<input type="text" name="apellidos" id="apellidos" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Telefono</label>
							<input type="text" name="telefono" id="telefono" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Horario</label>
							<?php
								$campos = "*";
								$tabla = "Horario";

								$query = mysqli_query($con,"SELECT $campos FROM  $tabla");
							?>
							<select name="horario" id="horario" class="form-control" required>
								<?php while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['id_horario'];?>"><?php echo $row['horario'];?></option>
								<?php } ?>
							</select>
						</div>
							<input type="hidden" name="status" id="status" value="Activo">
						<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
						<div class="form-group">
							<label>Profesor</label>
							<?php
								$campos = "usuario, nombre";
								$tabla = "Usuarios";
								$sWhere= "rol = 'Profesor'";
								$query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
							?>
							<select name="usuario" id="usuario" class="form-control" required>
							<option value="">-----</option>
								<?php while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['usuario'];?>"><?php echo $row['nombre'];?></option>
								<?php } ?>
							</select>
						</div>
						<?php }else{ ?>
							<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['u_usuario']; ?>">
						<?php } ?>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success" value="Guardar datos">
					</div>
				</form>
			</div>
		</div>
	</div>