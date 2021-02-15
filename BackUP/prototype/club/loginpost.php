<?php 
include_once 'inc/conexion.php';

	$redirect = '/';
	$link = '/';
	$retorno = '';

if (!empty($_POST)){

	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}

	$usuario = htmlspecialchars($_POST['us']);
	$pass = md5( htmlspecialchars($_POST['con']));
	//$pass =  htmlspecialchars($_POST['con']);
	
	$data = mysql_query("SELECT * from usuarios where usuario = '$usuario' and estado = 'Activo' and tipo in('Administrador','Secretario','Tesorero','Auditor','Presidente','SA');");
	$resultado = mysql_fetch_assoc($data);	
		
	if ($usuario == $resultado['usuario']){
		
		if ($pass == $resultado['clave']){
			
			$_SESSION['usuario'] = $usuario;
			$_SESSION['iniciado'] = '5dbc98dcc983a70728bd082d1a47546e';
			$_SESSION['tipo'] = $resultado['tipo'];
			
			$querylogin=" select ifnull(max(codigo),0)+1 as maxid from log_accesos";
			$resp = mysql_query($querylogin);
			while($datos = mysql_fetch_array($resp)) {
				$elmaximo = $datos['maxid'];
			} ;
			$data2 = mysql_query("INSERT INTO log_accesos (codigo,usuario,fecha) VALUES ('$elmaximo','$usuario',NOW());");
			
			$redirect = 'redirect';
			$link = 'index.php';

		}else{
			$retorno = 'Clave incorrecta';
		}
		
	}else{
		$retorno = 'Usuario incorrecto';
	}
	
}

$arr = array('lblerror' => $retorno, 'redireccion' => $redirect, 'link' => $link);
echo json_encode( $arr );

?>