<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$ide = $_POST['ide'];
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
			
				$add = mysql_query("UPDATE embarcaciones SET nombre = '$vnombreemb', arboladura = '$varboladura', casco = '$vcasco', eslora = '$veslora', manga = '$vmanga', 
				puntal = '$vpuntal', calado = '$vcalado', tonelaje = '$vtonelaje', motormarca = '$vmarcamotor', motornumero = '$vnumeromotor', motorpotencia = '$vpotmotor', 
				matricula = '$vmatricula', rey = '$vrey', inspeccion = '$vfechainsp', elementos = '$velementos', fechaupdate = NOW(), idmodificausuario = '$vusuariocarga' 
				WHERE id = '$ide'");
				if($add){
					header("location:consultarembarcacion.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:consultarembarcacion.php?retorno=" .mysql_error());
				}
			}
?>