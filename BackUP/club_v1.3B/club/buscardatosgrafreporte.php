<?php
include_once 'inc/conexion.php';

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$elsql="SELECT DATE_FORMAT(fechapago,'%m/%Y') AS fecha, SUM(importe) as total FROM cobros WHERE fechapago BETWEEN CONCAT('$desde','-01') AND CONCAT('$hasta','-31') GROUP BY MONTH(fechapago) ORDER BY fechapago ASC";
$select = mysql_query($elsql); 
$array_prueba = array();
//echo $elsql;

	while($datos = mysql_fetch_array($select)) {
		
			$array_prueba[] = array('fecha'=>$datos['fecha'],'total'=>$datos['total']);
			
	}
echo json_encode($array_prueba);
?>