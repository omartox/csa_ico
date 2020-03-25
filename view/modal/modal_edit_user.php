<?php

$campos = "*";
$tabla = "Roles";

$query = mysqli_query($con,"SELECT $campos FROM  $tabla ORDER BY Roles.descripcion DESC ");
?>
<div id="editUsuariosModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_userF" id="edit_userF">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" name="edit_usuario" id="edit_usuario" class="form-control" readonly="readonly">
							
							
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<input type="password" name="edit_contrasena" id="edit_contrasena" class="form-control" required>
						</div>
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
						<div class="form-group">
							<label>Rol</label>
							<select name="edit_rol" id="edit_rol" class="form-control" required>
								<?php while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['rol'];?>"><?php echo $row['rol'];?></option>
								<?php } ?>
							</select>
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

	