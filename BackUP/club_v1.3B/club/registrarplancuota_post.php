<?php
	include_once 'inc/conexion.php';
		
	$DATA = json_decode($_POST['data']);
	$todoOk = 1;
	
	//buscamos si no existe el dni
	$queryusuario=" select ifnull(max(id),0)+1 as maxid from plan_socio";
	$resp = mysql_query($queryusuario);
	while($datos = mysql_fetch_array($resp)) {
		$elmaximo = $datos['maxid'];
	};
	
	$add = mysql_query("CALL SP_PLAN_SOCIO_CREATE('$DATA[0]','$DATA[1]')");
	
	if($add){

		for ($i=3; $i < count($DATA); $i++) {
		
			$q[$i] = mysql_query("INSERT INTO plan_socio_familiar (plan_socio_id, familiar_id) VALUES ('$elmaximo', '".$DATA[$i]->familiar_id."')");
			
		}
	}
?>