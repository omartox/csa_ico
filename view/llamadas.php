<?php
session_start();
if(!isset($_SESSION['u_usuario'])){ 
	echo "<h3><center><a href='login'> Sesión expirada, Salir</a></center></h3>";
  }else{
    require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
	date_default_timezone_set('America/Monterrey'); 
	if(date("w")==0)
		$sem = date("W")+1;
	else
		$sem = date("W");
?>
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">

    <!-- Content Header (Page header) -->
	<section class="content-header">
      <h1>
        Llamadas
        <small>Reporte de llamadas a los alumnos</small>
      </h1>
     
    </section>


    <!-- Main content -->
  <section class="content">
	  <div id="resultados"></div><!-- Carga de datos ajax aqui -->
		<div class="box box-defaul">
			<div class="box-body">
				<div class="row">
					<div class="col-sm-2 col-sm-4">
						<button class="btn btn-success " onclick='mostrar_boxLlamada()'><i class="fa fa-fw fa-plus-circle"></i> Registrar Llamada</button>
					</div>
					<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
					<div class="col-sm-2 pull-right col-sm-4">
					
						<div class="input-group ">
							<span class="input-group-btn">
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addReporte"><span class="fa fa-print"></span> Imprimir Reporte </button>
							</span>
						</div>
				
					</div>
					<?php } ?>
				</div>

			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

		<div class="box box-defaul" id="solicitar_llamadaBox">
			<div class="box-body">
			<form name="select_llamadaF" id="select_llamadaF">
				<input type="hidden" name="fecha" value="<?php echo date("Y-m-d H:i:s"); ?>">
				<input type="hidden" name="semana" value="<?php echo $sem; ?>">
				<div class="row">
				<?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
					<div class="col-md-4 col-xs-12">
						<div class="form-group">
							<label>Profesor</label>
							<select class="form-control select2 select_busqueda" id="profe" name="profe" style="width: 100%;">
							<option value=""></option>
								<?php
								$campos = "nombre, apellidos, usuario, rol";
								$tabla = "Usuarios";
								$sWhere = "rol = 'Profesor'";
								$query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
								while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['usuario'];?>"><?php echo $row['nombre'];?> <?php echo $row['apellidos'];?></option>
								<?php } ?>
							</select>
							
						</div>
					</div>
					<?php } else{?>
						<input type="hidden" name="profe" value="<?php echo $_SESSION['u_usuario']; ?>">
					<?php } ?>	
					<div class="col-md-4 col-xs-12">
            			<div class="form-group">
							<label>Horario</label>
							<select class="form-control select2 select_busqueda" id="horario" name="horario" style="width: 100%;">
							<option value=""></option>
							<?php
							$campos = "*";
							$tabla = "Horario";
							
							$query = mysqli_query($con,"SELECT $campos FROM  $tabla ");
							while($row = mysqli_fetch_array($query)){ ?>
								<option value="<?php echo $row['id_horario'];?>"><?php echo $row['horario'];?></option>
							<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row" id="resultAlumnos">
					<div class="col-md-12">
						<div id="mostrar_solicitud">
							<!-- LIstado de alumnos a realizar llamada -->
							
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

		  <div id="listar_semanas">
        
        </div>

  </section>
    <!-- /.content -->

    <!-- Modal HTML -->
	<?php include("modal/modal_delete_llamada.php");?>
	<?php include("modal/modal_generar_reporte.php");?>
	<?php include("modal/modal_edit_llamada.php");?>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Page script -->

<script>

		$("#delete_llamadaF").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_delete_llamada.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					listar_semanas();
					$('#deleteLlamada').modal('hide');
				  }
			})
		  event.preventDefault();
		});

		$("#add_reporte").submit(function( event ) {
			$('#addReporte').modal('hide');
			//$('#add_reporte')[0].reset();
		});

		$('#deleteLlamada').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var idllamada = button.data('idllamada') 
		  $('#delete_llamada').val(idllamada)
        })

		$("#edit_llamada").submit(function( event ) {
		  var parametros = $(this).serialize();
			$.ajax({
					type: "POST",
					url: "model/control_edit_llamada.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados").html("Enviando...");
					  },
					success: function(datos){
					$("#resultados").html(datos);
					listar_semanas();
					$('#editLlamada').modal('hide');
					$('#edit_llamada')[0].reset();
				  }
			})
		  event.preventDefault();
		});

    $('#editLlamada').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var alumno = button.data('alumno') 
		  $('#alumno').html(alumno)
		  var id_llamada = button.data('idllamada')
		  $('#id_llamada').val(id_llamada)
		  		  		  
        })
	$(".select_busqueda").change(function( event ) {
	
		  ajax_add_llamada();
	});

	function ajax_add_llamada(){
		var parametros = $("#select_llamadaF").serialize();
			$.ajax({
					type: "POST",
					async:false,
					url: "model/control_reg_llamada.php",
					data: parametros,
					 beforeSend: function(objeto){
						console.log("cargando...");
					  },
					success: function(datos){
						console.log("Success");
						$("#mostrar_solicitud").html(datos);
						
				  }
			})
		  event.preventDefault();
	}
	
	$("#select_llamadaF").submit(function( event ) {
		  var parametros = $("#select_llamadaF").serialize();
		  Pace.restart();
			$.ajax({
					type: "POST",
					url: "model/control_add_llamada.php",
					data: parametros,
					 beforeSend: function(objeto){
						console.log("cargando...");
					  },
					success: function(datos){
						$('#select_llamadaF')[0].reset();
						console.log(datos);
						$("#resultados").html(datos);
						listar_semanas();
						$("#solicitar_llamadaBox").hide();
				  }
			})
		  event.preventDefault();
    });
        

        
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
	$('.select2').select2()
	
	ocultar_boxLlamada();
	listar_semanas();
	
  })

  function listar_semanas(){    
      $("#listar_semanas").hide();
            $.ajax({
                async:false,
                url: "model/control_listar_llamadas.php",
                beforeSend: function(objeto){
                    console.log("cargando...");
                },
                success: function(data){
                  
                  $("#listar_semanas").html(data).fadeIn(500);
                
                }
            })
		};
		
  	function mostrar_boxLlamada(){   
		$("#mostrar_solicitud").html(' ');
			$('#solicitar_llamadaBox').show();
			$('#profe').val(null).trigger('change'); 
			$('#horario').val(null).trigger('change'); 
			
		 };
		 
	function ocultar_boxLlamada(){    
		$("#mostrar_solicitud").html(' ');
		$("#solicitar_llamadaBox").hide();
		
    };
</script>
<?php }?>