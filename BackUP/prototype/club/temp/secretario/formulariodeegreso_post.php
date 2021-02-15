<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vcodigoafilia = mysql_real_escape_string($_POST['busqueda']);
	$observa = mysql_real_escape_string($_POST['tiposol']).': '.mysql_real_escape_string($_POST['observacion']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos si no existe el dni
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from solicitudes";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_num_rows(mysql_query("select * from solicitudes where socio_id = (select id from socios where nsocio = $vcodigoafilia) and estado = 'Pendiente' and tipo = 'Egreso'"));
				$add2 = mysql_num_rows(mysql_query("select * from socios where nsocio = $vcodigoafilia and estado != 'Activo' and estado != 'Aprobado'"));
				if($add){
					header("location:formulariodeegreso.php?retorno=" ."El socio ya posee una solicitud pendiente");
				}else{
					if($add2){
						header("location:formulariodeegreso.php?retorno=" ."El socio se encuentra innactivo");
					}else{
						$add3 = mysql_query("INSERT INTO solicitudes (id,socio_id,tipo,observacion,estado,fechaalta,idaltausuario,fechaupdate,idmodificausuario) 
								VALUES('$elmaximo',(select id from socios where nsocio = $vcodigoafilia),'Egreso','$observa','Pendiente',NOW(),'$vidaltausuario','','')");
						if($add3){
							header("location:formulariodeegreso.php?retorno=Cargado correctamente&m=s");
						}else{
							header("location:formulariodeegreso.php?retorno=" ."Error, el número de socio no exciste");
						}
					}
				}
			}
?>