<?php
include_once 'inc/conexion.php';

$idul = $_POST['lblidu'];

$elsql="SELECT p.periodo as periodo, p.cuota as cuota, p.detalle as detalle, p.importe as importe, 
pa.importetotal as importetotal FROM pago_detalle p INNER JOIN pagos pa on pa.id = p.pago_id 
WHERE p.pago_id = '$idul'";
$select = mysql_query($elsql); 
// echo $elsql;
	while($datos = mysql_fetch_array($select)) {
	
                    $output[] = array('periodo'=>$datos[0],'cuota'=>$datos[1],'detalle'=>$datos[2],'importe'=>$datos[3],'importetotal'=>$datos[4]);
					
                } ;
	echo json_encode($output);
?>
