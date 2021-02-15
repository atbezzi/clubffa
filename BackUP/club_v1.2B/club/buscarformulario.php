<?php 
include_once 'inc/conexion.php';

	$redirect = '/';
	$link = '/';
	$retorno = '';

	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	
	$idu = htmlspecialchars($_REQUEST['idsolicitud']);
	
	$resp = mysql_query("select id, estado from solicitudes where id = $idu");
				while($datos = mysql_fetch_array($resp)) {
					$vestado= $datos['estado'];
				}
	
	if ($vestado == 'Pendiente'){
		
	$query1 = ("select sol.id as idsol, sol.tipo as tiposol, s.nsocio as numsocio, s.nombre as nombre, s.apellido as apellido, sol.observacion as motivo, sol.estado as estado 
	from solicitudes sol inner join socios s on s.id=sol.socio_id WHERE sol.id = '$idu' and sol.estado = 'Pendiente'");

	$resp1 = mysql_query($query1);
	
	$total1 = mysql_num_rows($resp1) ;
	if ($total1 == 1)
	{
		
		while($datos = mysql_fetch_array($resp1)) {
			$vidsol = $datos['idsol'];
			$vtiposol = $datos['tiposol'];
			$vnumsocio = $datos['numsocio'];
			$vnombre = $datos['nombre'];
			$vapellido = $datos['apellido'];
			$vmotivo = $datos['motivo'];
			$vestado = $datos['estado'];
			$vpres = "No presenta";
			$vobservacion = "No presenta";
			$encontro="SI";
		} ;
	
		
	}else{
			$vidsol = "error";
			$vtiposol = "error";
			$vnumsocio = "error";
			$vnombre = "error";
			$vapellido = "error";
			$vmotivo = "error";
			$vestado = "error";
			$vpres = "error";
			$vobservacion = "error";
			$encontro="NO";
	}

$arr1 = array('idsol' => $vidsol, 'tiposol' => $vtiposol, 'numsocio' => $vnumsocio, 'nombre' => $vnombre, 'apellido' => $vapellido, 'motivo' => $vmotivo, 
'estado' => $vestado, 'nomusuario' => $vpres, 'observacion' => $vobservacion, 'encontro' => $encontro);
echo json_encode( $arr1 );

	}else{
		
	$query2 = ("select sol.id as idsol, sol.tipo as tiposol, s.nsocio as numsocio, s.nombre as nombre, s.apellido as apellido, sol.observacion as motivo, sol.estado as estado, 
	sd.presidente as presidente, sd.observacion as observacion, u.id as idusuario, u.usuario as nomusuario from solicitudes sol 
	inner join solicitud_detalle sd on sd.solicitud_id = sol.id inner join socios s on s.id = sol.socio_id inner join usuarios u on u.id = sd.presidente 
	WHERE sol.id = '$idu' and sol.estado != 'Pendiente'");

	$resp2 = mysql_query($query2);
	
	$total2 = mysql_num_rows($resp2) ;
	if ($total2 == 1)
	{
		
		while($datos = mysql_fetch_array($resp2)) {
			$vidsol = $datos['idsol'];
			$vtiposol = $datos['tiposol'];
			$vnumsocio = $datos['numsocio'];
			$vnombre = $datos['nombre'];
			$vapellido = $datos['apellido'];
			$vmotivo = $datos['motivo'];
			$vestado = $datos['estado'];
			$vpres = $datos['nomusuario'];
			$vobservacion = $datos['observacion'];
			$encontro="SI";
		} ;
	
		
	}else{
			$vidsol = "error";
			$vtiposol = "error";
			$vnumsocio = "error";
			$vnombre = "error";
			$vapellido = "error";
			$vmotivo = "error";
			$vestado = "error";
			$vpres = "error";
			$vobservacion = "error";
			$encontro="NO";
	}

$arr2 = array('idsol' => $vidsol, 'tiposol' => $vtiposol, 'numsocio' => $vnumsocio, 'nombre' => $vnombre, 'apellido' => $vapellido, 'motivo' => $vmotivo, 
'estado' => $vestado, 'nomusuario' => $vpres, 'observacion' => $vobservacion, 'encontro' => $encontro);
echo json_encode( $arr2 );
	}
	
	

?>