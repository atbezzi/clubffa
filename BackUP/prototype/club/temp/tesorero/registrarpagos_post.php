<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vrecibo = mysql_real_escape_string($_POST['recibo']);
	$vdetalle = mysql_real_escape_string($_POST['detalle']);
	$vimporte = mysql_real_escape_string($_POST['importe']);
	$vfechapago = mysql_real_escape_string($_POST['fechapago']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from pagos";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO pagos (id,recibo,detalle,importe,fecha,fechaalta,idaltausuario,fechaupdate,idmodificausuario) 
				values ('$elmaximo','$vrecibo','$vdetalle','$vimporte','$vfechapago',NOW(),'$vidaltausuario','','')");
				if($add){
					header("location:registrarpagos.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:registrarpagos.php?retorno=" .mysql_error());
				}
			}
?>