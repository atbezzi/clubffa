<?php 
include_once 'inc/conexion.php';

	$redirect = '/';
	$link = '/';
	$retorno = '';

	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	
	$idu = htmlspecialchars($_REQUEST['idafilia']);
	
	$query = "select * from afiliados where idafiliado = $idu";

	$resp = mysql_query($query);
	
	$total = mysql_num_rows($resp) ;
	if ($total ==1)
	{
		
		while($datos = mysql_fetch_array($resp)) {
		
			$tipoafiliado = $datos['tipo'];
			$nombreafiliado = $datos['nombre'];
			$apellidoafiliado = $datos['apellido'];
			$dniafiliado = $datos['dni'];
			$idafiliado = $datos['idafiliado'];
			$encontro="SI";

		} ;
	
		
	}else{
			$encontro="NO";
			$tipoafiliado = "error";
			$nombreafiliado = "error";
			$apellidoafiliado = "error";
			$dniafiliado = "error";
			$idafiliado = "error";
	}

$arr = array('tipo' => $tipoafiliado, 'nombre' => $nombreafiliado, 'apellido' => $apellidoafiliado, 'dni' => $dniafiliado, 'idafiliado' => $idafiliado, 'encontro' => $encontro);
echo json_encode( $arr );

?>