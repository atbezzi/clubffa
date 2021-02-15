<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idsocio = mysql_real_escape_string($_POST['parentescosocio']);
	$ids = mysql_real_escape_string($_POST['ids']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from plan_socio_familiar";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO plan_socio_familiar (id,plan_socio_id,familiar_id,fechaalta,idaltausuario,fechaupdate,idmodificausuario) 
				VALUES ('$elmaximo','$ids','$idsocio',NOW(),'$vidaltausuario','','');");
				if($add){
					header("location:consultarafiliados.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:consultarafiliados.php?retorno=" .mysql_error());
				}
			}
?>