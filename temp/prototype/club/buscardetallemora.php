<?php
include_once 'inc/conexion.php';

$idul = $_POST['lblidu'];

$elsql="select c.periodo, p.descripcion, c.importe, c.vencimiento from cuotas c inner join plan_socio ps on ps.id = c.plan_socio_id inner join planes p on p.id = ps.plan_id 
inner join socios s on s.id = ps.socio_id where c.estado = 'Pendiente' and EXTRACT(YEAR_MONTH FROM c.vencimiento) <= EXTRACT(YEAR_MONTH FROM now()) and s.nsocio = '$idul'";
$select = mysql_query($elsql); 
// echo $elsql;
	while($datos = mysql_fetch_array($select)) {
	
                    $output[] = array('periodo'=>$datos[0],'descripcion'=>$datos[1],'importe'=>$datos[2],'vencimiento'=>$datos[3]);
					
                } ;
	echo json_encode($output);
?>
