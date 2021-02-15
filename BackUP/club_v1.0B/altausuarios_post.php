<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vusuario = mysql_real_escape_string($_POST['usuario']);
	$vclave = mysql_real_escape_string(md5($_POST['clave']));
	$vmail = mysql_real_escape_string($_POST['email']);
	$vestado = mysql_real_escape_string($_POST['estado']);
	$vtipo = mysql_real_escape_string($_POST['tipo']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$queryusuario=" select ifnull(max(idusuario),0)+1 as maxid from usuarios";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO usuarios (id,usuario,clave,email,tipo,fechaalta,idaltausuario,fechaupdate,idmodificausuario) values('$elmaximo','$vusuario','$vclave','$vmail','$vtipo',NOW(),'$vidaltausuario','','') ");
				if($add){
					header("location:altausuarios.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:altausuarios.php?retorno=" .mysql_error());
				}
			}
?>