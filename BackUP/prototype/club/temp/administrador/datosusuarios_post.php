<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vnombre = mysql_real_escape_string($_POST['nombre']);
	$vapellido = mysql_real_escape_string($_POST['apellido']);
	$vdni = mysql_real_escape_string($_POST['dni']);
	$vfechanac = mysql_real_escape_string($_POST['fechanac']);
	$vcalle = mysql_real_escape_string($_POST['calle']);
	$vtelefono = mysql_real_escape_string($_POST['telefono']);
	$vcelular = mysql_real_escape_string($_POST['celular']);
	$vemail = mysql_real_escape_string($_POST['email']);
	$vusuariocarga = mysql_real_escape_string($_POST['usuariocarga']);
	$idu = mysql_real_escape_string($_POST['idu']);
	$todoOk = 1;
				$add = mysql_query("UPDATE perfiles SET nombre='$vnombre',apellido='$vapellido',dni='$vdni',fechanac='$vfechanac',domicilio='$vcalle',telefono='$vtelefono',celular='$vcelular',email='$vemail',fechaupdate=NOW(),idmodificausuario='$vusuariocarga' WHERE usuario_id=(SELECT id FROM usuarios WHERE usuario='$vusuariocarga')");
				if($add){
					header("location:datosusuarios.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:datosusuarios.php?retorno=" .mysql_error());
				}
			}
?>