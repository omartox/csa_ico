<?php
session_start();
if(!isset($_SESSION['u_usuario'])){ 
	echo "<h3><center><a href='login'> Sesión expirada, Salir</a></center></h3>";
  }else{
    require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
    date_default_timezone_set('America/Monterrey');
    $sem = date("W");
    
	//$query2 = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere2");
?>

<!-- fullCalendar -->
<link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
	<!-- Content Header (Page header) -->
	<section class="content-header">
      <h1>
        Tablero
        <small>Control panel</small>
      </h1>
     
    </section>


    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3><?php
                    $campos = "count(semana) as n_l";
                    $tabla = "Llamadas";
                    $sWhere= "semana = $sem";
                    $query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
                    if($resultado = mysqli_fetch_array($query)){
                        echo $resultado['n_l'];
                    }
                    else{
                        //header("Location: index.php?e=1");
                    }
                    ?></h3>

                    <p>Reportes de llamadas, semana <b><?php echo $sem; ?></b></p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-list-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                    <h3><?php
                    $campos = "count(status) as n_a";
                    $tabla = "Alumnos";
                    $sWhere= "status = 'Activo'";
                    $query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
                    if($resultado = mysqli_fetch_array($query)){
                        echo $resultado['n_a'];
                    }
                    else{
                        //header("Location: index.php?e=1");
                    }
                    ?></h3>

                    <p>Alumnos activos</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-graduation-cap"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                    <h3><?php
                    $campos = "count(status) as n_b";
                    $tabla = "Alumnos";
                    $sWhere= "status = 'Baja'";
                    $query = mysqli_query($con,"SELECT $campos FROM  $tabla where $sWhere");
                    if($resultado = mysqli_fetch_array($query)){
                        echo $resultado['n_b'];
                    }
                    else{
                        //header("Location: index.php?e=1");
                    }
                    ?></h3>

                    <p>Alumnos Baja</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-user-times"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
        <div class="col-lg-6">
        <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
      </div>
      <!-- /.row (main row) -->
     
    </section>
    <!-- /.content -->
    <!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'HOY',
        month: 'mes',
        week : 'semana',
        day  : 'dia'
      },
      //Random default events
      events    : [
        
        
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      

      
    })
  })
</script>

  <?php }?>