<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idf = $_POST['idf'];
	$tiempo = strtotime("now");
	$vidembarca = mysql_real_escape_string($_POST['idembarca']);
	if(basename($_FILES['foto']['type']) == ""){
		header("location:fotoembarca.php?retorno=Cargado correctamente&m=s");
	}else{
		//Copiar foto
		$dir_subida = 'foto/embarcaciones/';
		$fichero_subido = $dir_subida . $vidembarca.'_'.$tiempo.'.'.basename($_FILES['foto']['type']);
		move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido);
		//
		$vfoto = $vidembarca.'_'.$tiempo.'.'.basename($_FILES['foto']['type']);
		$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
		$todoOk = 1;
		
		$querycaja=" select ifnull(max(id),0)+1 as maxid from foto_embarcacion";
		$resp = mysql_query($querycaja);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
		
		$add = mysql_query("INSERT INTO foto_embarcacion (id,embarcacion_id,foto) VALUES ('$elmaximo','$idf','$vfoto')");
		
		if($add){
			header("location:fotoembarca.php?retorno=Cargado correctamente&m=s&accion=modifica&idf=$idf");
		}else{
			header("location:fotoembarca.php?retorno=" .mysql_error());
		}	
	}
}
?>