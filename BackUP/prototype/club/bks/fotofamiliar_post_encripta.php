<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	
	$image = imagecreatefromjpeg($_FILES['avatar-2']['tmp_name']);
	ob_start();
	imagejpeg($image);
	$jpg = ob_get_contents();
	ob_end_clean();

	$idf = mysql_real_escape_string($_REQUEST['idf']);
	//$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	
	$jpg = str_replace('##','##',mysql_escape_string($jpg));

	$queryusuario=" select * from foto_socio where socio_id='$idf'";
	$resp = mysql_query($queryusuario);
	while($datos = mysql_fetch_array($resp)) {
		$encontro = "SI";
	} ;
	echo $encontro;
	if ($encontro == "SI"){
		$add = mysql_query("UPDATE foto_socio SET imagen = '$jpg' WHERE socio_id = '$idf'");
			/*if($add){
				header("location:consultarafiliados.php?retorno=Cargado correctamente&m=s");
			}else{
				header("location:consultarafiliados.php?retorno=" .mysql_error());
			}*/
	}else{
		echo $encontro;
		//echo "INSERT INTO foto_socio SET socio_id='$idf', imagen='$jpg'";
		$add = mysql_query("INSERT INTO foto_socio SET socio_id='$idf', imagen='$jpg'");
			/*if($add){
				header("location:consultarafiliados.php?retorno=Cargado correctamente&m=s");
			}else{
				header("location:consultarafiliados.php?retorno=" .mysql_error());
			}*/
	}
}
?>