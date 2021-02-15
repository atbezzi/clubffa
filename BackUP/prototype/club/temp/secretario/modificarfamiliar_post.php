<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idf = $_POST['idf'];
	$vtipoparentesco = mysql_real_escape_string($_POST['parentesco']);
	$vnombrepariente = mysql_real_escape_string($_POST['nompariente']);
	$vapellidopariente = mysql_real_escape_string($_POST['apepariente']);
	$vdnipariente = mysql_real_escape_string($_POST['dnipariente']);
	$vfechanac = mysql_real_escape_string($_POST['fechanac']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from familiares";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("UPDATE familiares SET nombre = '$vnombrepariente', apellido = '$vapellidopariente', dni = '$vdnipariente', fechanacimiento = '$vfechanac', 
				parentesco = '$vtipoparentesco', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' WHERE id = '$idf'");
				if($add){
					header("location:consultarfamiliar.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:consultarfamiliar.php?retorno=" .mysql_error());
				}
			}
?>