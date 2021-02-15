<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vclave = mysql_real_escape_string(md5($_POST['clave']));
	$vusuariocarga2 = mysql_real_escape_string($_POST['usuariocarga2']);
	$iduc = mysql_real_escape_string($_POST['iduc']);
	$todoOk = 1;
				$add = mysql_query("UPDATE usuarios SET clave='$vclave',fechaupdate=NOW(),idmodificausuario='$vusuariocarga2' WHERE usuario='$vusuariocarga2'");
				if($add){
					header("location:datosusuarios.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:datosusuarios.php?retorno=" .mysql_error());
				}
			}
?>