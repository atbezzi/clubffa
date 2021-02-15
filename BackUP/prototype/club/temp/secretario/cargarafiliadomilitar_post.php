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
	$vsitumilitar = mysql_real_escape_string($_POST['situmilitar']);
	$vgrado = mysql_real_escape_string($_POST['grado']);
	$vfuerza = mysql_real_escape_string($_POST['fuerza']);
	$vescalafon = mysql_real_escape_string($_POST['escalafon']);
	$vpromovidopor = mysql_real_escape_string($_POST['promovidopor']);
	$vprovmil = mysql_real_escape_string($_POST['provmil']);
	$vlocalidadmil = mysql_real_escape_string($_POST['localidadmil']);
	$vfechaini = mysql_real_escape_string($_POST['fechaini']);
	$vfechahasta = mysql_real_escape_string($_POST['fechahasta']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	$todoOk = 1;
				
				//buscamos si no existe el dni
				$querycaja=" select ifnull(max(id),0)+1 as maxid from socios";
				$resp = mysql_query($querycaja);
				while($datos = mysql_fetch_array($resp)) {
					$elmaximo = $datos['maxid'];
				} ;
				$querycaja2=" select ifnull(max(id),0)+1 as maxid2 from sociosm";
				$resp2 = mysql_query($querycaja2);
				while($datos2 = mysql_fetch_array($resp2)) {
					$elmaximo2 = $datos2['maxid2'];
				} ;	
				$querycaja3=" select ifnull(max(id),0)+1 as maxid3 from solicitudes";
				$resp3 = mysql_query($querycaja3);
				while($datos3 = mysql_fetch_array($resp3)) {
					$elmaximo3 = $datos3['maxid3'];
				} ;
				$add = mysql_query("INSERT INTO socios (id,nsocio,nombre,apellido,localidadnacimiento,fechanacimiento,dni,estadocivil,sexo,domicilio,barrio,localidad_id,cp,telefono,celular,email,formadepago,domiciliocobrador,barriocobrador,localidad_idcobrador,zona_id,libro,acta,tipo,categoria_id,estadoembarcadero,estado,fechaalta,idaltausuario,fechaupdate,idmodificausuario) VALUES('$elmaximo','$vnumsocio','$vnombre','$vapellido','$vlocalidad','$vfechanac','$vdni','$vestadocivil','$vsexo','$vcalle','$vbarrio','$vlocalidadviveen','$vcpostal','$vtelefono','$vcelular','$vemail','$vformapago','$vdomicobrador','$vbarriocobrador','$vlocalidadcobra','$vzona','$vlibro','$vacta','Militar','$vcategorias','$vembarca','Pendiente',NOW(),'$vidaltausuario','','')");
				$add2 = mysql_query("INSERT INTO sociosm (id,socio_id,situacionmilitar,grado_id,fuerza_id,escalafon_id,promovidopor,localidad_id,serviciodesde,serviciohasta,estado,fechaalta,idaltausuario,fechaupdate,idmodificausuario) VALUES('$elmaximo2','$elmaximo','$vsitumilitar','$vgrado','$vfuerza','$vescalafon','$vpromovidopor','$vlocalidadmil','$vfechaini','$vfechahasta','Activo',NOW(),'$vidaltausuario','','')");
				$add3 = mysql_query("INSERT INTO solicitudes (id,socio_id,tipo,estado,fechaalta,idaltausuario,fechaupdate,idmodificausuario) VALUES('$elmaximo3','$elmaximo','Ingreso','Pendiente',NOW(),'$vidaltausuario','','')");
				
				if($add){
					if($add2){
						if($add3){
							header("location:cargarafiliadomilitar.php?retorno=Cargado correctamente&m=s");
						}else{
							header("location:cargarafiliadomilitar.php?retorno=" ."El numero de socio ya existe");
						}
					}else{
						header("location:cargarafiliadomilitar.php?retorno=" ."El numero de socio ya existe");
					}
				}else{
					header("location:cargarafiliadomilitar.php?retorno=" ."El numero de socio ya existe");
				}
			}
?>