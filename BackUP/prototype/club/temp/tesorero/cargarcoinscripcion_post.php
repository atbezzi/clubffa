<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$vidu = mysql_real_escape_string($_POST['idu']);
	$vrecibo = mysql_real_escape_string($_POST['recibo']);
	$vfechapago = mysql_real_escape_string($_POST['fechapago']);
	$vimptotal = mysql_real_escape_string($_POST['imptotal']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
		//buscamos maximo
		$queryusuario=" select ifnull(max(id),0)+1 as maxid from cobros";
		$resp = mysql_query($queryusuario);
		while($datos = mysql_fetch_array($resp)) {
			$elmaximo = $datos['maxid'];
		} ;
				$add = mysql_query("INSERT INTO cobros (id,socio_id,recibo,detalle,importe,fechapago,fechaalta,idaltausuario) VALUES('$elmaximo','$vidu','$vrecibo','Inscripcion','$vimptotal',NOW(),NOW(),'$vidaltausuario')");
				if($add){
					$add2 = mysql_query("UPDATE socios SET estado = 'Activo' WHERE id = '$vidu'");
					header("location:buscarimprimircobrosdos.php?accion=imprimir&idu=$vidu&close=dor");
				}else{
					header("location:cargarinscripcion.php?retorno=" .mysql_error());
				}
			}
?>
