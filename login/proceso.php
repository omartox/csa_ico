<?php 

session_start();
require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos

$usuario = mysqli_real_escape_string($con,(strip_tags($_POST["TxtUsuario"],ENT_QUOTES)));
$contrasena = mysqli_real_escape_string($con,(strip_tags($_POST["TxtContra"],ENT_QUOTES)));




$proceso = mysqli_query($con,"SELECT * FROM Usuarios WHERE usuario='$usuario' AND contrasena='$contrasena' ");

	if($resultado = mysqli_fetch_array($proceso)){
		$_SESSION['u_usuario'] = $resultado['usuario'];
		$_SESSION['u_rol'] = $resultado['rol'];
		header("Location: ../index.php");
	}
	else{
		header("Location: index.php?e=1&usuario=$usuario&contrasena=$contrasena");
	}


?>