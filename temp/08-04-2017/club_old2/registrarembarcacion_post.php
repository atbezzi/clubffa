<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vnumerolegajo = mysql_real_escape_string($_POST['legajo']);
	$vantiguedad = mysql_real_escape_string($_POST['antiguedad']);
	$vdni = mysql_real_escape_string($_POST['dni']);
	$vnombre = mysql_real_escape_string($_POST['nombre']);
	$vapellido = mysql_real_escape_string($_POST['apellido']);
	$vlugartrabajo = mysql_real_escape_string($_POST['lugartrabajo']);
	$varea = mysql_real_escape_string($_POST['area']);
	$vmonto = mysql_real_escape_string($_POST['monto']);
	$vcuotas = mysql_real_escape_string($_POST['cuotas']);
	$vinteres = mysql_real_escape_string($_POST['interes']);
	$todoOk = 1;
				//buscamos si no existe el dni
				$querycaja=" select ifnull(max(idprestamo),0)+1 as maxid from pp_prestamospersonales";
		$resp = mysql_query($querycaja);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO pp_prestamospersonales (idprestamo,nrolegajo,antiguedad,dni,nombre,apellido,lugartrabajo,areatrabajo,fechapedido,montopedido,interes,cantcuotas,estado) values('$elmaximo','$vnumerolegajo','$vantiguedad','$vdni','$vnombre','$vapellido','$vlugartrabajo','$varea',now(),'$vmonto','$vinteres','$vcuotas','P')");
				if($add){
					header("location:registrarembarcacion.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:registrarembarcacion.php?retorno=" .mysql_error());
				}
			}
?>