<?php 
include_once 'inc/conexion.php';

	$redirect = '/';
	$link = '/';
	$retorno = '';

	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	
	$idu = htmlspecialchars($_REQUEST['id']);
	
	$query = ("SELECT s.id as id, s.nsocio as nsocio, s.nombre as nombre, s.apellido as apellido, s.localidadnacimiento as localidadnacimiento, s.fechanacimiento as fechanacimiento, 
	s.dni as dni, s.estadocivil as estadocivil, s.sexo as sexo, s.domicilio as domicilio, s.barrio as barrio, s.localidad_id as localidad_id, s.cp as cp, s.telefono as telefono, 
	s.celular as celular, s.email as email, s.formadepago as formadepago, s.domiciliocobrador as domiciliocobrador, s.barriocobrador as barriocobrador, 
	s.localidad_idcobrador as localidad_idcobrador, s.zona_id as zona_id, s.libro as libro, s.acta as acta, s.tipo as tipo, s.categoria_id as categoria_id, 
	s.estadoembarcadero as estadoembarcadero, s.estado as estado, l.id as idlocalidad, l.descripcion as descripcion, l2.id as idlocalidad2, l2.descripcion as descripcion2, 
	l3.id as idlocalidad3, l3.descripcion as descripcion3 FROM socios s INNER JOIN localidades l ON l.id = s.localidadnacimiento INNER JOIN localidades l2 ON l2.id = s.localidad_id 
	INNER JOIN localidades l3 ON l3.id = s.localidad_idcobrador WHERE s.id = '$idu'");

	$resp = mysql_query($query);
	
	$total = mysql_num_rows($resp) ;
	if ($total == 1)
	{
		
		while($datos = mysql_fetch_array($resp)) {
			$vtipo = $datos['tipo'];
			$vnsocio = $datos['nsocio'];
			$vnombre = $datos['nombre'];
			$vapellido = $datos['apellido'];
			$vlocalidadnacimiento = $datos['descripcion'];
			$vfechanacimiento = $datos['fechanacimiento'];
			$vdni = $datos['dni'];
			$vestadocivil = $datos['estadocivil'];
			$vsexo = $datos['sexo'];
			$vcalle = $datos['domicilio'];
			$vbarrio = $datos['barrio'];
			$vlocalidad_id = $datos['descripcion2'];
			$vcp = $datos['cp'];
			$vtelefono = $datos['telefono'];
			$vcelular = $datos['celular'];
			$vemail = $datos['email'];
			$vformadepago = $datos['formadepago'];
			$vdomiciliocobrador = $datos['domiciliocobrador'];
			$vbarriocobrador = $datos['barriocobrador'];
			$vlocalidad_idcobrador = $datos['descripcion3'];
			$vzona_id = $datos['zona_id'];
			$vlibro = $datos['libro'];
			$vacta = $datos['acta'];
			$vcategoria_id = $datos['categoria_id'];
			$vestadoembarcadero = $datos['estadoembarcadero'];
			$vestado = $datos['estado'];
			$encontro="SI";
		} ;
	
		
	}else{
			$vtipo = "error";
			$vnsocio = "error";
			$vnombre = "error";
			$vapellido = "error";
			$vlocalidadnacimiento = "error";
			$vfechanacimiento = "error";
			$vdni = "error";
			$vestadocivil = "error";
			$vsexo = "error";
			$vcalle = "error";
			$vbarrio = "error";
			$vlocalidad_id = "error";
			$vcp = "error";
			$vtelefono = "error";
			$vcelular = "error";
			$vemail = "error";
			$vformadepago = "error";
			$vdomiciliocobrador = "error";
			$vbarriocobrador = "error";
			$vlocalidad_idcobrador = "error";
			$vzona_id = "error";
			$vlibro = "error";
			$vacta = "error";
			$vcategoria_id = "error";
			$vestadoembarcadero = "error";
			$vestado = "error";
			$encontro="NO";
	}

$arr = array('tipo' => $vtipo, 'nsocio' => $vnsocio, 'nombre' => $vnombre, 'apellido' => $vapellido, 'descripcion' => $vlocalidadnacimiento, 
'fechanacimiento' => $vfechanacimiento, 'dni' => $vdni, 'estadocivil' => $vestadocivil, 'sexo' => $vsexo, 'domicilio' => $vcalle, 'barrio' => $vbarrio, 
'descripcion2' => $vlocalidad_id, 'cp' => $vcp, 'telefono' => $vtelefono, 'celular' => $vcelular, 'email' => $vemail, 'formadepago' => $vformadepago, 
'domiciliocobrador' => $vdomiciliocobrador, 'barriocobrador' => $vbarriocobrador, 'descripcion3' => $vlocalidad_idcobrador, 'zona_id' => $vzona_id, 'libro' => $vlibro, 
'acta' => $vacta, 'categoria_id' => $vcategoria_id, 'estadoembarcadero' => $vestadoembarcadero, 'estado' => $vestado, 'encontro' => $encontro);
echo json_encode( $arr );

?>