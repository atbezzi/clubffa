<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vdescripcion = mysql_real_escape_string($_POST['zona']);
	$vprovincia_id = mysql_real_escape_string($_POST['nacidoen']);
	$vbarrio = mysql_real_escape_string($_POST['barrio']);
	$vlocalidad_id = mysql_real_escape_string($_POST['localidad']);
	$vidaltazona = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from zonas";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO zonas (id,descripcion,barrio,localidad_id,fechaalta,idaltausuario,fechaupdate,idmodificausuario) values('$elmaximo','$vdescripcion','$vbarrio','$vlocalidad_id',NOW(),'$vidaltazona','','') ");
				if($add){
					header("location:registrarzonas.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:registrarzonas.php?retorno=" .mysql_error());
				}
			}
?>