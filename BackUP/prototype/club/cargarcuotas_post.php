<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vdescripcion = mysql_real_escape_string($_POST['descripcion']);
	$vdetalle = mysql_real_escape_string($_POST['detalle']);
	$vcategoria = mysql_real_escape_string($_POST['categoria']);
	$vfamiliar = mysql_real_escape_string($_POST['familiar']);
	$vimptotal = mysql_real_escape_string($_POST['totales']);
	$vcantmeses = mysql_real_escape_string($_POST['cantmeses']);
	$vidaltazona = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		/*buscamos si no existe el dni
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from zonas";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;*/
				$add = mysql_query("INSERT INTO planes (descripcion, detalle, categoria_id, cantidad_familiar, importe, meses, fechaalta, idaltausuario) 
				VALUES ('$vdescripcion','$vdetalle','$vcategoria','$vfamiliar','$vimptotal','$vcantmeses',NOW(),'$vidaltazona')");
				if($add){
					header("location:cargarcuotas.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:cargarcuotas.php?retorno=" .mysql_error());
				}
			}
?>