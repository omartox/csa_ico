
<div class="modal fade" id="editLlamada">
          <div class="modal-dialog">
            <div class="modal-content">
            <form name="edit_llamada" id="edit_llamada">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4  class="modal-title">Registrar Respuesta</h4>
              </div>
              <div class="modal-body">
                <h3 id="alumno" class="text-center">Alumno apellidos</h3>
                <div class="form-group">
					<label>Respuesta</label>
					<textarea class="form-control" name="respuesta_2" id="respuesta_2" rows="3" minlength="20" maxlength="150" required placeholder="Escribir..."></textarea>
			    </div>
                <input type="hidden" name="id_llamada" id="id_llamada">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Save changes</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->