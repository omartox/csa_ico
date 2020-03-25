<?php
$campos = "*";
$tabla = "Roles";

$query = mysqli_query($con,"SELECT $campos FROM  $tabla ORDER BY Roles.descripcion DESC ");
?>

<div id="addUserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_user" id="add_user">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" name="usuario"  id="usuario" class="form-control" required>
							
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<input type="password" name="contrasena" id="contrasena" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Apellidos</label>
							<input type="text" name="apellidos" id="apelllidos" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Telefono</label>
							<input type="tel" name="telefono" id="telefono" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Rol</label>
							<select name="rol" id="rol" class="form-control" required>
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

	