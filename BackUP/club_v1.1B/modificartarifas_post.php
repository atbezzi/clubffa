<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idc = $_POST['idc'];
	$vimpinsc = mysql_real_escape_string($_POST['impinsc']);
	$vcuotamensual = mysql_real_escape_string($_POST['impmensual']);
	$vimpfamili = mysql_real_escape_string($_POST['impfam']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
	
				$add = mysql_query("update categorias set importeinscripcion = '$vimpinsc', importecuota = '$vcuotamensual', importefamiliar = '$vimpfamili', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' where id = '$idc'");
				if($add){
					header("location:tarifas.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:tarifas.php?retorno=" .mysql_error());
				}
			}
?>