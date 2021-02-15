<?php
include_once 'inc/conexion.php';

$idul = htmlspecialchars($_REQUEST['id']);

$elsql="select ps.id as idplan, p.descripcion as descripcion, (select COUNT(c.id) from cuotas c where c.plan_socio_id = ps.id and c.estado = 'Pagado') as pagadas, 
p.cantidad_cuota as cuotas, ps.vencimiento as vencimiento from planes p inner join plan_socio ps on ps.plan_id = p.id inner join socios s on s.id = ps.socio_id 
where s.id = '$idul' and ps.estado = 'Pendiente'";
$select = mysql_query($elsql); 
// echo $elsql;
	while($datos = mysql_fetch_array($select)) {
	
                    $output[] = array('idplan'=>$datos[0],'descripcion'=>$datos[1],'cuotas'=>$datos[2],'pagadas'=>$datos[3],'vencimiento'=>$datos[4]);
					
                } ;
	echo json_encode($output);
?>
