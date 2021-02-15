<?php
include_once 'inc/conexion.php';

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$elsql="SELECT LEFT(fechapago, 7) AS fecha, SUM(importetotal) as total FROM pagos WHERE fechapago BETWEEN '$desde' AND '$hasta' GROUP BY MONTH(fechapago) ORDER BY fechapago ASC";
$select = mysql_query($elsql); 
$array_prueba = array();
//echo $elsql;

	while($datos = mysql_fetch_array($select)) {
		
			$array_prueba[] = array('fecha'=>$datos['fecha'],'total'=>$datos['total']);
			
	}
echo json_encode($array_prueba);
?>