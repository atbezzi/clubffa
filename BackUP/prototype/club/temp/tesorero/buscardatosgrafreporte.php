<?php
include_once 'inc/conexion.php';

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//$elsql="SELECT DATE_FORMAT(fechapago,'%m/%Y') AS fecha, SUM(importe) as total FROM cobros WHERE fechapago BETWEEN CONCAT('$desde','-01') AND CONCAT('$hasta','-31') GROUP BY MONTH(fechapago) ORDER BY fechapago ASC";
$elsql="SELECT LEFT(pepe.fecha, 7) as fecha, SUM(IFNULL(c2.importe,0)) as sumacobro, SUM(IFNULL(p2.importe,0)) as sumapago FROM 
(SELECT c.fechapago as fecha FROM cobros c WHERE c.fechapago BETWEEN CONCAT('$desde','-01') AND CONCAT('$hasta','-31') GROUP BY c.fechapago 
UNION 
SELECT p.fecha as fecha FROM pagos p WHERE p.estado = 'Activo' AND p.fecha BETWEEN CONCAT('$desde','-01') AND CONCAT('$hasta','-31') GROUP BY p.fecha ORDER BY fecha) as pepe 
LEFT JOIN cobros c2 on c2.fechapago = pepe.fecha 
LEFT JOIN pagos p2 on p2.fecha = pepe.fecha GROUP BY month(pepe.fecha) ORDER BY pepe.fecha asc";
$select = mysql_query($elsql); 
$array_prueba = array();
//echo $elsql;

	while($datos = mysql_fetch_array($select)) {
		
			$array_prueba[] = array('fecha'=>$datos['fecha'],'sumacobro'=>$datos['sumacobro'],'sumapago'=>$datos['sumapago']);
			
	}
echo json_encode($array_prueba);
?>