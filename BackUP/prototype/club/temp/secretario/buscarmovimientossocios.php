<?php
include_once 'inc/conexion.php';

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$elsql="SELECT DATE_FORMAT(s.fechaupdate,'%m/%Y') AS fecha, 
(SELECT COUNT(s2.fechaupdate) FROM solicitudes s2 WHERE s2.estado = 'Aprobado' AND s2.tipo = 'Ingreso' AND left(s.fechaupdate,7) = LEFT(s2.fechaupdate,7)) AS alta, 
(SELECT COUNT(s3.fechaupdate) FROM solicitudes s3 WHERE s3.estado = 'Aprobado' AND s3.tipo = 'Egreso' AND LEFT(s.fechaupdate,7) = LEFT(s3.fechaupdate,7)) AS baja, 
((SELECT COUNT(s2.fechaupdate) FROM solicitudes s2 WHERE s2.estado = 'Aprobado' AND s2.tipo = 'Ingreso' AND LEFT(s2.fechaupdate,7)<=LEFT(s.fechaupdate,7)) - 
(SELECT COUNT(s3.fechaupdate) FROM solicitudes s3 WHERE s3.estado = 'Aprobado' AND s3.tipo = 'Egreso' AND LEFT(s3.fechaupdate,7)<=LEFT(s.fechaupdate,7))) AS cantidad 
FROM solicitudes s WHERE s.fechaupdate BETWEEN CONCAT('$desde','-01') AND CONCAT('$hasta','-31') GROUP BY MONTH(s.fechaupdate) ORDER BY s.fechaupdate ASC";
$select = mysql_query($elsql); 
$array_prueba = array();
//echo $elsql;

	while($datos = mysql_fetch_array($select)) {
		
			$array_prueba[] = array('fecha'=>$datos['fecha'],'alta'=>$datos['alta'],'baja'=>$datos['baja'],'cantidad'=>$datos['cantidad']);
			
	}
echo json_encode($array_prueba);
?>