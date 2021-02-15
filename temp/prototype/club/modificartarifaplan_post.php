<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idp = $_POST['idp'];
	$vimpinsc = mysql_real_escape_string($_POST['impinsc']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
	
				$add = mysql_query("update planes set importe = '$vimpinsc', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' where id = '$idp'");
				if($add){
					header("location:planes.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:planes.php?retorno=" .mysql_error());
				}
			}
?>