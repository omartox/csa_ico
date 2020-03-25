
<div id="editAlumnoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_alumnoF" id="edit_alumnoF">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Alumno</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Credencial</label>
							<input type="text" name="edit_credencial" id="edit_credencial" class="form-control" readonly="readonly">
						</div>
                        <div class="form-group">
							<label>Horario</label>
							<?php
								$campos = "*";
								$tabla = "Horario";

								$query = mysqli_query($con,"SELECT $campos FROM  $tabla");
							?>
							<select name="edit_idhorario" id="edit_idhorario" class="form-control" required>
								<?php while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['id_horario'];?>"><?php echo $row['horario'];?></option>
								<?php } ?>
							</select>
						</div>
                        <div class="form-group">
							<label>Profesor</label>
							<?php
								$campos = "usuario, nombre";
								$tabla = "Usuarios";
								$sWhere= "rol = 'Profesor'";
								$query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
							?>
							<select name="edit_usuario" id="edit_usuario" class="form-control" required>
								<?php while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['usuario'];?>"><?php echo $row['nombre'];?></option>
								<?php } ?>
							</select>
						</div>
                        <div class="form-group">
							<label>Status</label>
							<select name="edit_status" id="edit_status" class="form-control" required>
                                <option value="Activo">Activo</option>
                                <option value="Baja">Baja</option>
							</select>
						</div>
                        <hr>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="edit_nombre" id="edit_nombre" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Apellidos</label>
							<input type="text" name="edit_apellidos" id="edit_apellidos" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Telefono</label>
							<input type="tel" name="edit_telefono" id="edit_telefono" class="form-control" required>
						</div>
						
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success" value="Guardar datos">
					</div>
				</form>
			</div>
		</div>
	</div>

	