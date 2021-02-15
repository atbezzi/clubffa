<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idf = $_POST['idf'];
	$vnsocio = mysql_real_escape_string($_POST['idflia']);
	if(basename($_FILES['foto']['type']) == ""){
		header("location:consultarfamiliar.php?retorno=Cargado correctamente&m=s");
	}else{
		//Copiar foto
		$dir_subida = 'foto/familiar/';
		$fichero_subido = $dir_subida . $vnsocio . '.' . basename($_FILES['foto']['type']);
		move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido);
		//
		$vfoto = $vnsocio.'.'.basename($_FILES['foto']['type']);
		$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
		$todoOk = 1;
		
		$add = mysql_query("UPDATE familiares SET foto = '$vfoto' WHERE id = '$idf'");
		
		if($add){
			header("location:consultarfamiliar.php?retorno=Cargado correctamente&m=s");
		}else{
			header("location:consultarfamiliar.php?retorno=" .mysql_error());
		}	
	}
}
?>