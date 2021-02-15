<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vzona = mysql_real_escape_string($_POST['zona']);
	$vnombrecobrador = mysql_real_escape_string($_POST['nombrecobrador']);
	$vapellidocobrador = mysql_real_escape_string($_POST['apellidocobrador']);
	$vdni = mysql_real_escape_string($_POST['dni']);
	$vdomicilio = mysql_real_escape_string($_POST['domicilio']);
	$vtelefono = mysql_real_escape_string($_POST['telefono']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from cobradores";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO cobradores (id,zona_id,nombre,apellido,dni,domicilio,telefono,fechaalta,idaltausuario,fechaupdate,idmodificausuario) values('$elmaximo','$vzona','$vnombrecobrador','$vapellidocobrador','$vdni','$vdomicilio','$vtelefono',NOW(),'$vidaltausuario','','') ");
				if($add){
					header("location:registrarcobrador.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:registrarcobrador.php?retorno=" .mysql_error());
				}
			}
?>