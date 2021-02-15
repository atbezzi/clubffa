<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
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
	$vocupacion = mysql_real_escape_string($_POST['ocupacion']);
	$vdomiciocupa = mysql_real_escape_string($_POST['domiciocupa']);
	$vbarrioocupa = mysql_real_escape_string($_POST['barrioocupa']);
	$vprovocupa = mysql_real_escape_string($_POST['provocupa']);
	$vlocalidadocupa = mysql_real_escape_string($_POST['localidadocupa']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
	
				$add = mysql_query("UPDATE socios SET nsocio = '$vnumsocio', nombre = '$vnombre', apellido = '$vapellido', localidadnacimiento = '$vlocalidad', fechanacimiento = '$vfechanac', dni = '$vdni', 
				estadocivil = '$vestadocivil', sexo = '$vsexo', domicilio = '$vcalle', barrio = '$vbarrio', localidad_id = '$vlocalidadviveen', cp = '$vcpostal', telefono = '$vtelefono', celular = '$vcelular', email = '$vemail', formadepago = '$vformapago', 
				domiciliocobrador = '$vdomicobrador', barriocobrador = '$vbarriocobrador', localidad_idcobrador = '$vlocalidadcobra', zona_id = '$vzona', libro = '$vlibro', acta = '$vacta', categoria_id = '$vcategorias', 
				estadoembarcadero = '$vembarca', fechaupdate  = NOW(), idmodificausuario = '$vidaltausuario'");
				$add2 = mysql_query("UPDATE sociosc SET ocupacion = '$vocupacion', domicilio = '$vdomiciocupa', barrio = '$vbarrioocupa', localidad_id = '$vlocalidadocupa', fechaupdate = NOW(), idmodificausuario = '$usuariocarga'"
				
				if($add){
					if($add2){
							header("location:consultarformularios.php?retorno=Cargado correctamente&m=s");
					}else{
						header("location:consultarformularios.php?retorno=" .mysql_error());
					}
				}else{
					header("location:consultarformularios.php?retorno=" .mysql_error());
				}
			}
?>