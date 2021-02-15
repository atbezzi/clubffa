<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idc = $_POST['idc'];
	$vzona = mysql_real_escape_string($_POST['zona']);
	$vnombrecobrador = mysql_real_escape_string($_POST['nombrecobrador']);
	$vapellidocobrador = mysql_real_escape_string($_POST['apellidocobrador']);
	$vdni = mysql_real_escape_string($_POST['dni']);
	$vdomicilio = mysql_real_escape_string($_POST['domicilio']);
	$vtelefono = mysql_real_escape_string($_POST['telefono']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;

				$add = mysql_query("update cobradores set zona_id = '$vzona', nombre = '$vnombrecobrador', apellido = '$vapellidocobrador', dni = '$vdni', domicilio = '$vdomicilio', telefono = '$vtelefono', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = '$idc'");
				if($add){
					header("location:consultarcobrador.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:consultarcobrador.php?retorno=" .mysql_error());
				}
			}
?>