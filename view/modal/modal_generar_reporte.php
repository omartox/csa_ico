<?php
$campos = "*";
$tabla = "Usuarios ";
$wWhere = "rol= 'Profesor'";
$query = mysqli_query($con,"SELECT $campos FROM  $tabla WHERE $wWhere");
?>

<div id="addReporte" class="modal fade">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<form name="add_reporte" method="post" action="fpdf/generar_reporte.php" id="add_reporte" target="_blank">
					<div class="modal-header">						
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                    	<h4 class="modal-title">Reporte de Llamadas</h4>
					</div>
					<div class="modal-body">
                    <div class="form-group">
							<label>Semana:</label>
							<select name="semana" id="semana" class="form-control" required>
								<?php if(date("w")==0)
										$sem = date("W")+1;
									else
										$sem = date("W");?>
								<option value="<?php echo $sem;?>"><?php echo $sem;?></option>
                                <option value="<?php echo $sem-1;?>"><?php echo $sem-1;?></option>
								<option value="<?php echo $sem-2;?>"><?php echo $sem-2;?></option>
                                <option value="<?php echo $sem-3;?>"><?php echo $sem-3;?></option>
							</select>
						</div>				
						<div class="form-group">
							<label>Profesor:</label>
							<select name="prof" id="prof" class="form-control" required>
                                <option value="todos">Todos</option>
								<?php while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['usuario'];?>"><?php echo $row['nombre'];?></option>
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

	