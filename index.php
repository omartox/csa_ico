<?php 
//hola
      session_start();
      if(!isset($_SESSION['u_usuario'])){ 
        header("Location: login/");
      }
      ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CSA | ICO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
      @font-face
      {
          font-family: 'ameliabt';
          src: url('fuentes/amelian.eot');
          src: url('fuentes/amelian.eot?#iefix') format('embedded-opentype'),
             
              url('fuentes/amelian.ttf') format('truetype'),
              url('fuentes/amelian.svg#ameliabt') format('svg');
          font-weight: normal;
          font-style: normal;
      }

      #SuperiorICO
      {
        font-family:'ameliabt';
        font-size:25pt;
        text-shadow: 1px 1px 0 #000;         
      }
    </style>
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="img/ICO.png" width="50px"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><span id='SuperiorICO'><img src="img/ICO.png"> CS Alumnos</span></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" >
              <img src="img/perfil.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['u_usuario']; ?></span>
            </a>
          </li>
          <li class="dropdown user user-menu">
            <a href="login/logout.php" class="dropdown-toggle" >
            <i class="fa fa-sign-out" aria-hidden="true"></i>
              Salir
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <?php if($_SESSION['u_rol'] != 'Profesor'){ ?>
        <li><a href="#" onclick='cargar_tablero()'><i class="fa fa-dashboard"></i> <span>Tablero</span></a></li>
        <?php } ?>
        <li><a href="#" onclick='cargar_llamadas()'><i class="fa fa-phone"></i> <span>Llamadas</span></a></li>
        <?php if($_SESSION['u_rol'] != 'Profesor' and $_SESSION['u_rol'] != 'Secretaria'){ ?>
        <li><a href="#" onclick='cargar_usuarios()'><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
        <?php } ?>
        <li><a href="#" onclick='cargar_alumnos()'><i class="fa fa-graduation-cap"></i> <span>Alumnos</span></a></li>
        <li class="header"><span class="fa fa-fw fa-support"></span>  Soporte - <span class="fa fa-fw fa-headphones"></span> 222 262 87 42</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="contenido">
    

    
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.2
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://icocompuingles.com">IcoCompuingles</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab"></div>
      <!-- /.tab-pane -->
      
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="bower_components/PACE/pace.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Metodos con ajax <script src="js/script.js"></script>-->

<script>
    $(function(){
      <?php if($_SESSION['u_rol'] == 'Profesor'){ ?>
        cargar_llamadas();
      <?php }else{?>
        cargar_tablero();
      <?php } ?>
    });


     function cargar_alumnos(){    
      $("#contenido").hide();
      Pace.restart();
            $.ajax({
                url: "view/alumnos.php",
                beforeSend: function(objeto){
                    $("#contenido").html("cargando..."); 
                },
                success: function(data){
                  
                  $("#contenido").html(data).fadeIn(500);
                
                }
            })
        };

      function cargar_tablero(){    
      $("#contenido").hide();
      Pace.restart();
            $.ajax({
                url: "view/tablero.php",
                beforeSend: function(objeto){
                    $("#contenido").html("cargando..."); 
                },
                success: function(data){
                  
                  $("#contenido").html(data).fadeIn(500);
                
                }
            })
        };

        function cargar_usuarios(){    
             $("#contenido").hide();
             Pace.restart();
             $.ajax({
                 url: "view/usuarios.php",
                 beforeSend: function(objeto){
                  $("#contenido").html("cargando..."); 
                 },
                 success: function(data){
                   
                   $("#contenido").html(data).fadeIn(500);
                 
                 }
             })
         };

         function cargar_llamadas(){    
             $("#contenido").hide();
             $.ajax({
                 url: "view/llamadas.php",
                 beforeSend: function(objeto){
                  $("#contenido").html("cargando..."); 
                 },
                 success: function(data){
                   
                   $("#contenido").html(data).fadeIn(500);
                 
                 }
             })
         };
    </script>
</body>
</html>
