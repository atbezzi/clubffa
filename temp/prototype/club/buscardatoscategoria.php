<?php
include_once 'inc/conexion.php';

$idcategoria = $_POST['idcategoria'];

$elsql="SELECT id, cantidad_familiar, importe FROM planes WHERE id = '$idcategoria'";
$select = mysql_query($elsql); 
$array_prueba = array();
//echo $elsql;

	while($datos = mysql_fetch_array($select)) {
		
			$array_prueba[] = array('id'=>$datos['id'],'cantidad_familiar'=>$datos['cantidad_familiar'],'importe'=>$datos['importe']);
			
	}
echo json_encode($array_prueba);
?>