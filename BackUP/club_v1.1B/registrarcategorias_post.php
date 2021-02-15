<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
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
	$vestado = mysql_real_escape_string($_POST['estado']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$querycat=" select ifnull(max(id),0)+1 as maxid from categorias";
		$resp = mysql_query($querycat);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO categorias (id,descripcion,descripcionbreve,derechovoto,importeinscripcion,importecuota,importefamiliar,cantidadfamiliar,cantidadavalante,tipo,fechaalta,idaltausuario,fechaupdate,idmodificausuario) values('$elmaximo','$vcategoria','$vbreve','$vvoto','$vimpinsc','$vcuotamensual','$vimpfamili','$vcantfamiliar','$vcantabalante','$vtipocategoria',NOW(),'$vidaltausuario','','') ");
				if($add){
					header("location:registrarcategorias.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:registrarcategorias.php?retorno=" .mysql_error());
				}
			}
?>