<?php 
include_once 'inc/conexion.php';

	$redirect = '/';
	$link = '/';
	$retorno = '';

	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	
	$ide = htmlspecialchars($_REQUEST['id']);
	
	$query = ("select e.nombre as nombre, e.arboladura as arboladura, e.casco as casco, e.eslora as eslora, e.manga as manga, e.puntal as puntal, 
				e.calado as calado, e.tonelaje as tonelaje, e.motormarca as motormarca, e.motornumero as motornumero, e.motorpotencia as motorpotencia, e.matricula as matricula, 
				e.rey as rey, e.inspeccion as inspeccion, e.elementos as elementos, s.nsocio as nsocio from embarcaciones e inner join socios s on s.id = e.socio_id 
				where e.id = $ide");

	$resp = mysql_query($query);
	
	$total = mysql_num_rows($resp) ;
	if ($total == 1)
	{
		
		while($datos = mysql_fetch_array($resp)) {
			$vnombreemb = $datos['nombre'];
			$varboladura = $datos['arboladura'];
			$vcasco = $datos['casco'];
			$veslora = $datos['eslora'];
			$vmanga = $datos['manga'];
			$vpuntal = $datos['puntal'];
			$vcalado = $datos['calado'];
			$vtonelaje = $datos['tonelaje'];
			$vmarcamotor = $datos['motormarca'];
			$vnumeromotor = $datos['motornumero'];
			$vpotmotor = $datos['motorpotencia'];
			$vmatricula = $datos['matricula'];
			$vrey = $datos['rey'];
			$vfechainsp = $datos['inspeccion'];
			$velementos = $datos['elementos'];
			$vcodigosocio = $datos['nsocio'];
			$encontro="SI";
		} ;
	
		
	}else{
			$vtipo = "error";
			$vnombreemb = "error";
			$varboladura = "error";
			$vcasco = "error";
			$veslora = "error";
			$vmanga = "error";
			$vpuntal = "error";
			$vcalado = "error";
			$vtonelaje = "error";
			$vmarcamotor = "error";
			$vnumeromotor = "error";
			$vpotmotor = "error";
			$vmatricula = "error";
			$vrey = "error";
			$vfechainsp = "error";
			$velementos = "error";
			$vcodigosocio = "error";
			$encontro="NO";
	}

$arr = array('nombre' => $vnombreemb, 'arboladura' => $varboladura, 'casco' => $vcasco, 'eslora' => $veslora, 'manga' => $vmanga, 
'puntal' => $vpuntal, 'calado' => $vcalado, 'tonelaje' => $vtonelaje, 'motormarca' => $vmarcamotor, 'motornumero' => $vnumeromotor, 'motorpotencia' => $vpotmotor, 'matricula' => $vmatricula, 
'rey' => $vrey, 'inspeccion' => $vfechainsp, 'elementos' => $velementos, 'socio_id' => $vcodigosocio, 'encontro' => $encontro);
echo json_encode( $arr );

?>