<?php
session_start();
if(!isset($_SESSION['u_usuario'])){ 
	echo "<h3><center><a href='login'> Sesión expirada, Salir</a></center></h3>";
  }else{
    require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
?>
	<!-- Content Header (Page header) -->
	<section class="content-header">
      <h1>
        Catálogo Alumnos
        <small></small>
      </h1>
     
    </section>


	<!-- Main content -->
    <section class="content">
	<div id="resultados"></div><!-- Carga de datos ajax aqui -->
		<div class="box box-defaul">
			<div class="box-body">
				<div class="row">
					<div class="col-sm-2 col-xs-4">
						<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAlumnoModal"><i class="fa fa-fw fa-plus-circle"></i> Añadir Alumno</button>
					</div>
					<div class="col-sm-4 pull-right col-xs-8">
					
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" placeholder="Buscar Alumno">
							<span class="input-group-btn">
								<button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
							</span>
						</div>
				
					</div>
				</div>

			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

		<div id="listar_alumnos">
        
        </div>


    </section>
    <!-- /.content -->

<!-- Edit Modal HTML -->
<?php include("modal/modal_add_alumno.php");?>
<?php include("modal/modal_edit_alumno.php");?>
<?php include("modal/modal_delete_alumno.php");?>

<script>
    $(function(){
        listar_alumnos();
    });


     function listar_alumnos(){    
      $("#listar_alumnos").hide();
            $.ajax({
                async:false,
                url: "model/control_listar_alumnos.php",
                beforeSend: function(objeto){
                    $("#listar_alumnos").html("cargando..."); 
                },
                success: function(data){
                  
                  $("#listar_alumnos").html(data).fadeIn(500);
                
                }
            })
        };

        $('#editAlumnoModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var credencial = button.data('credencial') 
		  $('#edit_credencial').val(credencial)
		  var nombre = button.data('nombre') 
		  $('#edit_nombre').val(nombre)
		  var apellidos = button.data('apellidos') 
		  $('#edit_apellidos').val(apellidos)
		  var telefono = button.data('telefono') 
          $('#edit_telefono').val(telefono)
          var idhorario = button.data('idhorario') 
          $('#edit_idhorario').val(idhorario)
          var status = button.data('status') 
          $('#edit_status').val(status)
		  var usuario = button.data('usuario') 
          $('#edit_usuario').val(usuario)
		  		  
        })
        
        $('#deleteAlumnoModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var credencial = button.data('credencial') 
		  $('#delete_credencial').val(credencial)
        })
       
		$("#add_alumno").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_guardar_alumno.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					
					$('#addAlumnoModal').modal('hide');
					$('#add_alumno')[0].reset();
					listar_alumnos();
				  }
			})
		  event.preventDefault();
        });
        
    
    $("#delete_alumnoF").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_delete_alumno.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					
					$('#deleteAlumnoModal').modal('hide');
					listar_alumnos();
				  }
			})
		  event.preventDefault();
		});
    
    

		$("#edit_alumnoF").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_edit_alumno.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					
					$('#editAlumnoModal').modal('hide');
					$('#edit_alumnoF')[0].reset();
					listar_alumnos();
				  }
			})
		  event.preventDefault();
		});
</script>

	<?php } ?>