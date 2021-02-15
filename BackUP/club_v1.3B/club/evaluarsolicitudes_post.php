<?php
include_once 'inc/conexion.php';
if (!empty($_POST)){
	$ids = $_POST['ids'];
	//$vaprueba = mysql_real_escape_string($_POST['my-checkbox']);
	$vnumsocio = mysql_real_escape_string($_POST['numerosocio']);
	$vobservacion = mysql_real_escape_string($_POST['observacion']);
	$vemail = mysql_real_escape_string($_POST['emailsocio']);
	$vapellido = mysql_real_escape_string($_POST['apellido']);
	$vnombre = mysql_real_escape_string($_POST['nombre']);
	$vidaltausuario = mysql_real_escape_string($_POST['usuariocarga']);
	
	$tiposolicitud="select tipo from solicitudes where id = '$ids'";
	$respuesta = mysql_query($tiposolicitud);
		while($data = mysql_fetch_array($respuesta)) {
			$tipsol = $data['tipo'];
		} ;
	if($tipsol == 'Ingreso'){
		if(isset($_POST['my-checkbox'])){
		$valtapres=date("Y-m-d");
		$vbajapres="NULL";
		  $vaprueba = 'Aprobado';
		  $vestado = 'Activo';
		
		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = $_POST['emailsocio'];
		$email_subject = "Contacto desde el CFFAA";
		$email_from = "cffaacba@gmail.com.ar";

		// Aquí se deberían validar los datos ingresados por el usuario
		if(!isset($_POST['observacion'])) {

		echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
		echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
		die();
		}

		$email_message = "Detalles del formulario de contacto:\n\n";
		$email_message .= "Estimado Sr/Sra: " . $_POST['apellido'] . ", " . $_POST['nombre'] . "\n";
		$email_message .= "Felicitaciones, su formulario de ingreso a sido aprobado, bienvenido al Club FFAA \n";
		$email_message .= "Observacion: " . $_POST['observacion'] . "\n";

		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);
		
		}else{
		$valtapres="NULL";
		$vbajapres="NULL";
		  $vaprueba = 'No aprobado';
		  $vestado = 'Inactivo';

		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = $_POST['emailsocio'];
		$email_subject = "Contacto desde el CFFAA";
		$email_from = "cffaacba@gmail.com.ar";

		// Aquí se deberían validar los datos ingresados por el usuario
		if(!isset($_POST['observacion'])) {

		echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
		echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
		die();
		}

		$email_message = "Detalles del formulario de contacto:\n\n";
		$email_message .= "Estimado Sr/Sra: " . $_POST['apellido'] . ", " . $_POST['nombre'] . "\n";
		$email_message .= "Su formulario de ingreso no a sido aprobado, por favor contactenos para mas información \n";
		$email_message .= "Observacion: " . $_POST['observacion'] . "\n";

		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);

		}
	}else{
		if(isset($_POST['my-checkbox'])){
		$valtapres="NULL";
		$vbajapres=date("Y-m-d");
		  $vaprueba = 'Aprobado';
		  $vestado = 'Inactivo';

		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = $_POST['emailsocio'];
		$email_subject = "Contacto desde el CFFAA";
		$email_from = "cffaacba@gmail.com.ar";

		// Aquí se deberían validar los datos ingresados por el usuario
		if(!isset($_POST['observacion'])) {

		echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
		echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
		die();
		}

		$email_message = "Detalles del formulario de contacto:\n\n";
		$email_message .= "Estimado Sr/Sra: " . $_POST['apellido'] . ", " . $_POST['nombre'] . "\n";
		$email_message .= "Su formulario de egreso a sido aprobado, sentimos que tenga que irse \n";
		$email_message .= "Observacion: " . $_POST['observacion'] . "\n";

		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);
		
		}else{
		$valtapres="NULL";
		$vbajapres="NULL";
		  $vaprueba = 'No aprobado';
		  $vestado = 'Activo';

		// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
		$email_to = $_POST['emailsocio'];
		$email_subject = "Contacto desde el CFFAA";
		$email_from = "cffaacba@gmail.com.ar";

		// Aquí se deberían validar los datos ingresados por el usuario
		if(!isset($_POST['observacion'])) {

		echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
		echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
		die();
		}

		$email_message = "Detalles del formulario de contacto:\n\n";
		$email_message .= "Estimado Sr/Sra: " . $_POST['apellido'] . ", " . $_POST['nombre'] . "\n";
		$email_message .= "Su formulario de egreso no a sido aprobado, por favor contactenos para mas información \n";
		$email_message .= "Observacion: " . $_POST['observacion'] . "\n";

		// Ahora se envía el e-mail usando la función mail() de PHP
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);

		}
	}
	
	$todoOk = 1;
	
	
	
				//buscamos si no existe el dni
				$querycaja="select ifnull(max(id),0)+1 as maxid from solicitud_detalle";
				$resp = mysql_query($querycaja);
				while($datos = mysql_fetch_array($resp)) {
					$elmaximo = $datos['maxid'];
				} ;

				$add = mysql_query("update solicitudes set estado = '$vaprueba', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' where id = '$ids'");
				$add2 = mysql_query("update socios set estado = '$vaprueba', altapres = '$valtapres', bajapres = '$vbajapres', fechaupdate = NOW(), idmodificausuario = '$vidaltausuario' where nsocio = '$vnumsocio'");
				$add3 = mysql_query("insert into solicitud_detalle (id,solicitud_id,presidente,voto,fecha,observacion,fechaalta,idaltausuario) values ('$elmaximo','$ids',(select id from usuarios where usuario = '$vidaltausuario'),'$vaprueba',NOW(),'$vobservacion',NOW(),'$vidaltausuario')");
				if($add){
					if($add2){
						if($add3){
							header("location:pendientesolicitudpres.php?retorno=Cargado correctamente&m=s");
						}else{
							header("location:pendientesolicitudpres.php?retorno=" .mysql_error());
						}
					}else{
						header("location:pendientesolicitudpres.php?retorno=" .mysql_error());
					}
				}else{
					header("location:pendientesolicitudpres.php?retorno=" .mysql_error());
				}
			}
?>