<?php 
      session_start();
      if(isset($_SESSION['u_usuario'])){ 
        header("Location: ../index.php");
      }
      ?>
<!DOCTYPE html>
<html>
<head>
	<title>ICO - CA</title>
	<link href="../AFI.css" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 	


</head>
<body id='AccesoBody'>
	<table style='width:100%;' summary=''>
   <tr>
	<td valign='top'>
	 <span id='AccesoICO'>INSTITUTO DE COMPUINGLES DE ORIENTE</span><br />
	 <span id='AccesoDIC'>Dirección Plantel Cholula</span>
	</td>
	<td valign="top" align='right'>
	 <table id='AccesoTablaAFI' summary=''>
	  <tr>
	   <td><img src='../img/icono-sombrero.png' width='120' height='auto' align="absmiddle"></td>
	   <td><span id='AccesoAFI1'>Control Seguimiento</span><br /><span id='AccesoAFI1'>de Alumnos</span></td>
	  </tr>
	 </table> 
	</td>
   </tr>
  </table>
  <br>
  <br>
  <br>
  <br>
  
  
<p>
  <form action="proceso.php" method="POST" name='FrmAcceso'>
  <table style='width:100%; height:70%' summary=''>
   <tr>
    <td valign="middle" align="center">
	 <table id='AccesoTablaForm' summary=''>
      <tr><th colspan='2' style='background-color:#24307D; color:#FFFFFF; text-align: center;'>Acceso al sistema</th></tr>
	  <?php if(isset($_GET['e'])){?>
	  <tr>
	  	<td colspan="2"><p class="text-danger text-center"><small>Usuario y/o contraseña incorrectos.</small></p></td>
	  </tr>
	  <?php } ?>
	  <tr>
	   <td>Usuario</td>
	   <td><input name='TxtUsuario' type='text'  /></td> 
	  </tr>
	  <tr>
	   <td>Contraseña</td>
  	   <td><input name='TxtContra' type='password' /></td> 
	  </tr>
	  <tr>
	   <td align='center' colspan='2'>
	    <input type='submit' value='Aceptar' class="btn btn-primary" />
	   </td> 
	  </tr>
     </table>
    </td>
   </tr>
  </table>
  </form>

	</p>
	<footer class="footer">
      <div class="container" style="text-align: center;">
        <span class="text-muted">Copyright © 2019 created by omartox </span>
      </div>
    </footer>


</body>
</html>