<?php
	include_once 'inc/conexion.php';
	
	$DATA = json_decode($_POST['data']);
	$todoOk = 1;
	//buscamos si no existe el dni
	$queryusuario="select ifnull(max(id),0)+1 as maxid from cobros";
	$resp = mysql_query($queryusuario);
	while($datos = mysql_fetch_array($resp)) {
		$elmaximo = $datos['maxid'];
	};

	$add = mysql_query("INSERT INTO cobros (id,socio_id,recibo,detalle,servicio,importe,fechapago,fechaalta,idaltausuario,fechaupdate,idmodificausuario) 
	VALUES('$elmaximo',(SELECT id FROM socios WHERE nsocio = '$DATA[0]'),'$DATA[1]','".$DATA[5]->descripcion."','".$DATA[5]->detalle."','$DATA[4]',NOW(),NOW(),'$DATA[3]','','')");
	
	if($add){
		$add2 = mysql_query("INSERT INTO plan_socio (plan_id,socio_id,vencimiento,fechaalta,idaltausuario,fechaupdate,idmodificausuario) 
		VALUES ('".$DATA[5]->id."',(SELECT id FROM socios WHERE nsocio = '$DATA[0]'),DATE_ADD( NOW(), INTERVAL ('".$DATA[5]->meses."') MONTH ),NOW(),'$DATA[3]','','')");
	}else{
		header("location:cargarcobrodos.php?retorno=" .mysql_error());
	}
	
?>
