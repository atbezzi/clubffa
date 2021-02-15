<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vnombreemb = mysql_real_escape_string($_POST['nombreemb']);
	$varboladura = mysql_real_escape_string($_POST['arboladura']);
	$vcasco = mysql_real_escape_string($_POST['casco']);
	$veslora = mysql_real_escape_string($_POST['eslora']);
	$vmanga = mysql_real_escape_string($_POST['manga']);
	$vpuntal = mysql_real_escape_string($_POST['puntal']);
	$vcalado = mysql_real_escape_string($_POST['calado']);
	$vtonelaje = mysql_real_escape_string($_POST['tonelaje']);
	$vmarcamotor = mysql_real_escape_string($_POST['marcamotor']);
	$vnumeromotor = mysql_real_escape_string($_POST['numeromotor']);
	$vpotmotor = mysql_real_escape_string($_POST['potmotor']);
	$vmatricula = mysql_real_escape_string($_POST['matricula']);
	$vrey = mysql_real_escape_string($_POST['rey']);
	$vfechainsp = mysql_real_escape_string($_POST['fechainsp']);
	$velementos = mysql_real_escape_string($_POST['elementos']);
	$vcodigosocio = mysql_real_escape_string($_POST['codigosocio']);
	$vusuariocarga = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
				//buscamos si no existe el dni
				$querycaja=" select ifnull(max(id),0)+1 as maxid from embarcaciones";
		$resp = mysql_query($querycaja);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO embarcaciones (id,nombre,arboladura,casco,eslora,manga,puntal,calado,tonelaje,motormarca,motornumero,motorpotencia,matricula,rey,inspeccion,elementos,socio_id,fechaalta,idaltausuario) 
				values('$elmaximo','$vnombreemb','$varboladura','$vcasco','$veslora','$vmanga','$vpuntal','$vcalado','$vtonelaje','$vmarcamotor','$vnumeromotor','$vpotmotor','$vmatricula','$vrey','$vfechainsp','$velementos',(SELECT id FROM socios WHERE $vcodigosocio = nsocio),NOW(),'$vusuariocarga')");
				if($add){
					header("location:registrarembarcacion.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:registrarembarcacion.php?retorno=" ."Número de socio inválido");
				}
			}
?>