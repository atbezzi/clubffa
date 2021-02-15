<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vcodigoafilia = mysql_real_escape_string($_POST['codigoafilia']);
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
				$add = mysql_query("INSERT INTO familiares (id,socio_id,nombre,apellido,dni,fechanacimiento,parentesco,fechaalta,idaltausuario) 
				values('$elmaximo',(SELECT id FROM socios WHERE nsocio = $vcodigoafilia),'$vnombrepariente','$vapellidopariente','$vdnipariente','$vfechanac', 
				'$vtipoparentesco',NOW(),'$vidaltausuario')");
				if($add){
					header("location:registrarfamiliar.php?retorno=Cargado correctamente&m=s");
				}else{
					header("location:registrarfamiliar.php?retorno=" ."Número de socio inválido");
				}
			}
?>