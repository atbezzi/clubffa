<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idc = $_POST['idc'];
	$vcategoria = mysql_real_escape_string($_POST['nombrecat']);
	$vbreve = mysql_real_escape_string($_POST['descbreve']);
	//$vvoto = mysql_real_escape_string($_POST['my-checkbox']);
	if(isset($_POST['my-checkbox'])){
	  $vvoto = 'Si';
	}else{
	  $vvoto = 'No';
	}
	$vimpinsc = mysql_real_escape_string($_POST['impinsc']);
	$vcuotamensual = mysql_real_escape_string($_POST['impmensual']);
	$vimpfamili = mysql_real_escape_string($_POST['impfam']);
	$vcantfamiliar = mysql_real_escape_string($_POST['cantflia']);
	$vcantabalante = mysql_real_escape_string($_POST['cantabalante']);
	$vtipocategoria = mysql_real_escape_string($_POST['tipocat']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$querycat=" select ifnull(max(id),0)+1 as maxid from categorias";
		$resp = mysql_query($querycat);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("update categorias set descripcion = '$vcategoria', descripcionbreve = '$vbreve', derechovoto = '$vvoto', importeinscripcion = '$vimpinsc', importecuota = '$vcuotamensual', importefamiliar = '$vimpfamili', cantidadfamiliar = '$vcantfamiliar', cantidadavalante = '$vcantabalante', tipo = '$vtipocategoria', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' where id = '$idc'");
				if($add){
					header("location:consultarcategorias.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:consultarcategorias.php?retorno=" .mysql_error());
				}
			}
?>