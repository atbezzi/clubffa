<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idz = $_POST['idz'];
	$vdescripcion = mysql_real_escape_string($_POST['zona']);
	$vbarrio = mysql_real_escape_string($_POST['barrio']);
	$vlocalidad_id = mysql_real_escape_string($_POST['localidad']);
	$vidmodificausuario = mysql_real_escape_string($_POST['usuariocarga']);

	$todoOk = 1;

				$add = mysql_query("update zonas set descripcion = '$vdescripcion', barrio = '$vbarrio', localidad_id = '$vlocalidad_id', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = '$idz'");
				if($add){
					header("location:consultarzonas.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:consultarzonas.php?retorno=" .mysql_error());
				}
			}
?>