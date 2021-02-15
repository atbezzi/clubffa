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
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from usuarios";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
		$queryusuario2=" select ifnull(max(id),0)+1 as maxid from perfiles";
		$resp2 = mysql_query($queryusuario2);
		while($datos2 = mysql_fetch_array($resp2)) {
			$elmaximo2 = $datos2['maxid'];
		} ;
				$add = mysql_query("INSERT INTO usuarios (id,usuario,clave,email,tipo,fechaalta,idaltausuario,fechaupdate,idmodificausuario) values('$elmaximo','$vusuario','$vclave','$vmail','$vtipo',NOW(),'$vidaltausuario','','') ");
				$add2 = mysql_query("INSERT INTO perfiles (id,usuario_id,fechaalta,idaltausuario,fechaupdate,idmodificausuario) values('$elmaximo2','$elmaximo',NOW(),'$vidaltausuario','','') ");
				if($add){
					if($add2){
						header("location:altausuarios.php?retorno=Cargado correctamente&m=s");
					}else{
						header("location:altausuarios.php?retorno=" ."El nombre de usuario ya existe");
					}
				}else{
					header("location:altausuarios.php?retorno=" ."El nombre de usuario ya existe");
				}
			}
?>