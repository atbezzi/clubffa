<?php
include_once 'inc/conexion.php';

$idfamilia = $_POST['idfamilia'];

$elsql="SELECT id, nombre, apellido, dni, fechanacimiento, parentesco FROM familiares WHERE id = '$idfamilia'";
$select = mysql_query($elsql); 
$array_prueba = array();
//echo $elsql;

	while($datos = mysql_fetch_array($select)) {
		
			$array_prueba[] = array('id'=>$datos['id'],'nombre'=>$datos['nombre'],'apellido'=>$datos['apellido'],'dni'=>$datos['dni'],'fechanacimiento'=>$datos['fechanacimiento'],'parentesco'=>$datos['parentesco']);
			
	}
echo json_encode($array_prueba);
?>