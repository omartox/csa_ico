<div id="deleteAlumnoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="delete_alumnoF" id="delete_alumnoF">
					<div class="modal-header">						
						<h4 class="modal-title">Eliminar Alumno</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>¿Seguro que quieres eliminar este registro?</p>
						<p class="text-danger"><small>Esta acción no se podra deshacer.</small></p>
						<input type="hidden" name="delete_credencial" id="delete_credencial">
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-danger" value="Eliminar">
					</div>
				</form>
			</div>
		</div>
	</div>
