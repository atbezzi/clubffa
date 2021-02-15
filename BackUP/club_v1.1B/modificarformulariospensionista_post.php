<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$idu = $_POST['idu'];
	$vfoto = mysql_real_escape_string($_POST['avatar-2']);
	$vnumsocio = mysql_real_escape_string($_POST['numsocio']);
	$vnombre = mysql_real_escape_string($_POST['nombre']);
	$vapellido = mysql_real_escape_string($_POST['apellido']);
	$vnacidoen = mysql_real_escape_string($_POST['nacidoen']);
	$vlocalidad = mysql_real_escape_string($_POST['localidad']);	
	$vfechanac = mysql_real_escape_string($_POST['fechanac']);
	$vdni = mysql_real_escape_string($_POST['dni']);
	$vestadocivil = mysql_real_escape_string($_POST['estadocivil']);
	$vsexo = mysql_real_escape_string($_POST['sexo']);
	$vcalle = mysql_real_escape_string($_POST['calle']);
	$vbarrio = mysql_real_escape_string($_POST['barrio']);
	$vviveen = mysql_real_escape_string($_POST['viveen']);
	$vlocalidadviveen = mysql_real_escape_string($_POST['localidadviveen']);
	$vcpostal = mysql_real_escape_string($_POST['cpostal']);
	$vtelefono = mysql_real_escape_string($_POST['telefono']);
	$vcelular = mysql_real_escape_string($_POST['celular']);
	$vemail = mysql_real_escape_string($_POST['email']);
	$vformapago = mysql_real_escape_string($_POST['formapago']);
	$vdomicobrador = mysql_real_escape_string($_POST['domicobrador']);
	$vbarriocobrador = mysql_real_escape_string($_POST['barriocobrador']);
	$vprovcobrador = mysql_real_escape_string($_POST['provcobrador']);
	$vlocalidadcobra = mysql_real_escape_string($_POST['localidadcobra']);
	$vzona = mysql_real_escape_string($_POST['zona']);
	$vlibro = mysql_real_escape_string($_POST['libro']);
	$vacta = mysql_real_escape_string($_POST['acta']);
	$vcategorias = mysql_real_escape_string($_POST['categorias']);
	$vembarca = mysql_real_escape_string($_POST['embarca']);
	$vgrado = mysql_real_escape_string($_POST['grado']);
	$vfuerza = mysql_real_escape_string($_POST['fuerza']);
	$vescalafon = mysql_real_escape_string($_POST['escalafon']);
	$vpromovidopor = mysql_real_escape_string($_POST['promovidopor']);
	$vprovpen = mysql_real_escape_string($_POST['provpen']);
	$vlocalidadpen = mysql_real_escape_string($_POST['localidadpen']);
	$vfechaini = mysql_real_escape_string($_POST['fechaini']);
	$vfechahasta = mysql_real_escape_string($_POST['fechahasta']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
	
				$add = mysql_query("UPDATE socios SET nombre = '$vnombre', apellido = '$vapellido', localidadnacimiento = '$vlocalidad', 
				fechanacimiento = '$vfechanac', dni = '$vdni', estadocivil = '$vestadocivil', sexo = '$vsexo', domicilio = '$vcalle', barrio = '$vbarrio', 
				localidad_id = '$vlocalidadviveen', cp = '$vcpostal', telefono = '$vtelefono', celular = '$vcelular', email = '$vemail', 
				formadepago = '$vformapago', domiciliocobrador = '$vdomicobrador', barriocobrador = '$vbarriocobrador', 
				localidad_idcobrador = '$vlocalidadcobra', zona_id = '$vzona', libro = '$vlibro', acta = '$vacta', categoria_id = '$vcategorias', 
				estadoembarcadero = '$vembarca', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' WHERE id = '$idu'");
				$add2 = mysql_query("UPDATE sociosp SET grado_id = '$vgrado', fuerza_id = '$vfuerza', 
				escalafon_id = '$vescalafon', promovidopor = '$vpromovidopor', localidad_id = '$vlocalidadpen', serviciodesde = '$vfechaini', 
				serviciohasta = '$vfechahasta', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' WHERE socio_id = '$idu'");
				
				if($add){
					if($add2){
						header("location:consultarafiliados.php?retorno=Cargado correctamente&m=s");
					}else{
						header("location:consultarafiliados.php?retorno=" .mysql_error());
					}
				}else{
					header("location:consultarafiliados.php?retorno=" .mysql_error());
				}
			}
?>