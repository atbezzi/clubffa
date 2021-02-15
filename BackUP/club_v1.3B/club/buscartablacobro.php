<?php
include_once 'inc/conexion.php';

$idul = $_POST['lblidu'];

$elsql="SELECT DATE_FORMAT(p.periodo,'%d/%m/%Y') as periodo, p.detalle as detalle, p.importe as importe, pa.importetotal as importetotal FROM pago_detalle p 
INNER JOIN pagos pa on pa.id = p.pago_id WHERE p.pago_id = '$idul'";
$select = mysql_query($elsql); 
// echo $elsql;
	while($datos = mysql_fetch_array($select)) {
	
                    $output[] = array('periodo'=>$datos[0],'detalle'=>$datos[1],'importe'=>$datos[2],'importetotal'=>$datos[3]);
					
                } ;
	echo json_encode($output);
?>
