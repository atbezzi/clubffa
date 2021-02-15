<?php 
include_once 'inc/conexion.php';

	$redirect = '/';
	$link = '/';
	$retorno = '';

	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	
	$idu = htmlspecialchars($_REQUEST['id']);
	
	$query1 = ("SELECT p.id as idperf, p.usuario_id, p.nombre, p.apellido, p.dni, DATE_FORMAT(p.fechanac, '%d/%m/%Y') as fechanacimiento, p.domicilio, p.telefono, p.celular, p.email 
	FROM perfiles p INNER JOIN usuarios u ON u.id = p.usuario_id WHERE u.id = '$idu'");

	$resp1 = mysql_query($query1);
	
	$total = mysql_num_rows($resp1) ;
	if ($total == 1)
	{
		
		while($datos = mysql_fetch_array($resp1)) {
			$vnombre = $datos['nombre'];
			$vapellido = $datos['apellido'];
			$vdni = $datos['dni'];
			$vfechanacimiento = $datos['fechanacimiento'];
			$vdomicilio = $datos['domicilio'];
			$vtelefono = $datos['telefono'];
			$vcelular = $datos['celular'];
			$vemail = $datos['email'];
			$encontro="SI";
		} ;
	
		
	}else{
			$vnombre = "error";
			$vapellido = "error";
			$vdni = "error";
			$vfechanacimiento = "error";
			$vdomicilio = "error";
			$vtelefono = "error";
			$vcelular = "error";
			$vemail = "error";
			$encontro="NO";
	}

$arr1 = array('nombre' => $vnombre, 'apellido' => $vapellido, 'dni' => $vdni, 'fechanacimiento' => $vfechanacimiento, 'domicilio' => $vdomicilio, 'telefono' => $vtelefono, 
'celular' => $vcelular, 'email' => $vemail, 'encontro' => $encontro);
echo json_encode( $arr1 );
?>