<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$ids = $_POST['ids'];
	//$vaprueba = mysql_real_escape_string($_POST['my-checkbox']);
	if(isset($_POST['my-checkbox'])){
	  $vaprueba = 'Aprobado';
	  $vestado = 'Activo';
	}else{
	  $vaprueba = 'No aprobado';
	  $vestado = 'Inactivo';
	}
	$vnumsocio = mysql_real_escape_string($_POST['numerosocio']);
	$vobservacion = mysql_real_escape_string($_POST['observacion']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
	
				//buscamos si no existe el dni
				$querycaja="select ifnull(max(id),0)+1 as maxid from solicitud_detalle";
				$resp = mysql_query($querycaja);
				while($datos = mysql_fetch_array($resp)) {
					$elmaximo = $datos['maxid'];
				} ;

				$add = mysql_query("update solicitudes set estado = '$vaprueba', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' where socio_id = '$ids'");
				$add2 = mysql_query("update socios set estado = '$vestado', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' where nsocio = '$vnumsocio'");
				$add3 = mysql_query("insert into solicitud_detalle (id,solicitud_id,presidente,voto,fecha,observacion,fechaalta,idaltausuario) values ('$elmaximo','$ids',(select id from usuarios where usuario = '$vidaltausuario'),'$vaprueba',NOW(),'$vobservacion',NOW(),'$vidaltausuario')");
				if($add){
					if($add2){
						if($add3){
							header("location:pendientesolicitudpres.php?retorno=Cargado correctamente&m=s");
						}else{
							header("location:pendientesolicitudpres.php?retorno=" .mysql_error());
						}
					}else{
						header("location:pendientesolicitudpres.php?retorno=" .mysql_error());
					}
				}else{
					header("location:pendientesolicitudpres.php?retorno=" .mysql_error());
				}
			}
?>