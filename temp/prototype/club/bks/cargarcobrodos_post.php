<?php
	include_once 'inc/conexion.php';
	
	$DATA = json_decode($_POST['data']);
	$todoOk = 1;
	//buscamos si no existe el dni
	$queryusuario=" select ifnull(max(id),0)+1 as maxid from pagos";
	$resp = mysql_query($queryusuario);
	while($datos = mysql_fetch_array($resp)) {
		$elmaximo = $datos['maxid'];
	};

	$add = mysql_query("INSERT INTO pagos (id,socio_id,recibo,importetotal,fechapago,fechaalta,idaltausuario,fechaupdate,idmodificausuario) 
	VALUES ('$elmaximo',(SELECT id FROM socios WHERE nsocio = $DATA[0]),'$DATA[1]','$DATA[4]','$DATA[2]',NOW(),'$DATA[3]','','')");
	
	if($add){
	
		for ($i=5; $i < count($DATA); $i++) {
		
			$q[$i] = mysql_query("INSERT INTO pago_detalle (pago_id, cuota_id, detalle, importe, periodo, fechaalta, idaltausuario, fechaupdate, idmodificausuario) VALUES ('$elmaximo', '".$DATA[$i]->id."', '".$DATA[$i]->descripcion."', '".$DATA[$i]->importe."', '".$DATA[$i]->periodo."', NOW(), '$DATA[3]', '', '')");
			$z[$i] = mysql_query("UPDATE cuotas SET estado = 'Pagado' WHERE id =  '".$DATA[$i]->id."'");
			
		}
	}
?>
