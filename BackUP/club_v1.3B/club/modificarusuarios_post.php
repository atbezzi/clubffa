<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idu = $_POST['idu'];
	$vusuario = mysql_real_escape_string($_POST['usuario']);
	$vclave = mysql_real_escape_string(md5($_POST['clave']));
	$vmail = mysql_real_escape_string($_POST['email']);
	$vestado = mysql_real_escape_string($_POST['estado']);
	$vtipo = mysql_real_escape_string($_POST['tipo']);
	$vidmodificausuario = mysql_real_escape_string($_POST['usuariocarga']);
	
	$todoOk = 1;

				$add = mysql_query("update usuarios set usuario = '$vusuario', clave = '$vclave', email = '$vmail', tipo = '$vtipo', fechaupdate = NOW(), idmodificausuario = '$vidmodificausuario' where id = '$idu'");
				if($add){
					header("location:estadousuarios.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:estadousuarios.php?retorno=" .mysql_error());
				}
			}
?>