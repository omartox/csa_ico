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
        Catálogo Usuarios
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
					<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-fw fa-plus-circle"></i> Añadir Usuario</button>
					</div>
					<div class="col-sm-4 pull-right col-xs-8">
					
						<div class="input-group input-group-sm">
							<input type="text" class="form-control" placeholder="Buscar Usuario">
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

		<div id="listar_usuarios">
        
        </div>


    </section>
    <!-- /.content -->

<!-- Edit Modal HTML -->
<?php include("modal/modal_add_user.php");?>
<?php include("modal/modal_edit_user.php");?>
<?php include("modal/modal_delete_user.php");?>
<script>
    $(function(){
        listar_usuarios();
    });


     function listar_usuarios(){    
      $("#listar_usuarios").hide();
            $.ajax({
                async:false,
                url: "model/control_listar_usuarios.php",
                beforeSend: function(objeto){
                    $("#listar_usuarios").html("cargando..."); 
                },
                success: function(data){
                  
                  $("#listar_usuarios").html(data).fadeIn(500);
                
                }
            })
        };

        $('#editUsuariosModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var usuario = button.data('usuario') 
		  $('#edit_usuario').val(usuario)
		  var nombre = button.data('nombre') 
		  $('#edit_nombre').val(nombre)
		  var apellidos = button.data('apellidos') 
		  $('#edit_apellidos').val(apellidos)
		  var telefono = button.data('telefono') 
          $('#edit_telefono').val(telefono)
          var rol = button.data('rol') 
          $('#edit_rol').val(rol)
          var contrasena = button.data('contrasena') 
          $('#edit_contrasena').val(contrasena)
		  
        })
        
        $('#deleteUsuarioModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var usuario = button.data('usuario') 
		  $('#delete_usuario').val(usuario)
        })
       
		$("#add_user").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_guardar_usuario.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					listar_usuarios();
					$('#addUserModal').modal('hide');
					$('#add_user')[0].reset();
				  }
			})
		  event.preventDefault();
        });
        
    
    $("#delete_userF").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_delete_user.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					listar_usuarios();
					$('#deleteUsuarioModal').modal('hide');
					
				  }
			})
		  event.preventDefault();
		});
    
    

		$("#edit_userF").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_edit_user.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					listar_usuarios();
					$('#editUsuariosModal').modal('hide');
					$('#edit_userF')[0].reset();
				  }
			})
		  event.preventDefault();
		});
	</script>
  
  <?php } ?>