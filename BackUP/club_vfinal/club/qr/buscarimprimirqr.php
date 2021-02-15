<?php
	if(session_id() == '' || !isset($_SESSION)) {
		session_start();
	}
	if (!(isset($_SESSION['iniciado']))) {
		header ("Location: login.php");
		exit();
	}
	if ($_SESSION['iniciado'] != '5dbc98dcc983a70728bd082d1a47546e'){
		header ("Location: login.php");
		exit();
	}
	 $con = mysql_connect('localhost','root', '');
            mysql_select_db('clubffaa', $con);
	
	error_reporting (0); //ocultar "notice"
	
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	
	if($_SESSION['tipo'] != 'Secretario'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$ide = $_REQUEST['ide'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon"  href="img/club.ico"/>
	<link rel="icon" href="club.ico">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="css/botones.css" rel="stylesheet">
	<title>Club de las Fuerzas Armadas de Cordoba</title>
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<!-- menu lateral -->
	<link href="css/menulateral.css" rel="stylesheet">
	<!-- menu lateral -->
	<link href="css/animate.css" rel="stylesheet">
	<!-- menu lateral -->
	<!-- datetimepicker -->
	<link href="css/datepicker.css" rel="stylesheet">
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">-->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body onload="imprimir();">
<div id="container">
	<div class="visible-xs" style="height:70px;"></div>
	<div class="visible-sm" style="height:30px;"></div>
	<div class="row" style="max-width:100%; margin-left:0px; margin-right:0px;">
		<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
			<div class="main1">
				<div class="content">
					<h2>Club FFAA</h2>
					<form id="frmcarga" name="frmcarga" method="post" action="reportedeingresos_post.php">
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">
									<?php 
									$qhacemos="nuevo";
									$ide = $_REQUEST['ide'];
									$accion = $_REQUEST['accion'];
									if ($accion =="imprimir"){
										
										$elsql="select e.nombre as nombre, e.arboladura as arboladura, e.casco as casco, e.eslora as eslora, e.manga as manga, e.puntal as puntal, 
										e.calado as calado, e.tonelaje as tonelaje, e.elementos as elementos, e.matricula as matricula, e.rey as rey, e.inspeccion as inspeccion, 
										s.nsocio as numsocio, s.nombre as nombresocio, s.apellido as apellidosocio, s.telefono as telsocio, s.email as mailsocio, s.celular as celusocio 
										from embarcaciones e inner join socios s on s.id = e.socio_id where e.id = '$ide'";
										$select = mysql_query($elsql); 
										while($datos = mysql_fetch_array($select)) {
											$vnombre = $datos['nombre'];
											$varboladura = $datos['arboladura'];
											$vcasco = $datos['casco'];
											$veslora = $datos['eslora'];
											$vmanga = $datos['manga'];
											$vpuntal = $datos['puntal'];
											$vcalado = $datos['calado'];
											$vtonelaje = $datos['tonelaje'];
											$velementos = $datos['elementos'];
											$vmatricula = $datos['matricula'];
											$vrey = $datos['rey'];
											$vinspeccion = $datos['inspeccion'];
											$vnumsocio = $datos['numsocio'];
											$vnombresocio = $datos['nombresocio'];
											$vapellidosocio = $datos['apellidosocio'];
											$vtelsocio = $datos['telsocio'];
											$vmailsocio = $datos['mailsocio'];
											$vcelusocio = $datos['celusocio'];
										}
										$UN_SALTO="\r\n";
										$todojunto = " Nombre: $vnombre, $UN_SALTO Arboladura: $varboladura, $UN_SALTO Casco: $vcasco, $UN_SALTO Eslora: $veslora, $UN_SALTO Manga: $vmanga, $UN_SALTO Puntal: $vpuntal, $UN_SALTO Calado: $vcalado, $UN_SALTO Tonelaje: $vtonelaje, $UN_SALTO Elementos: $velementos, $UN_SALTO Matricula: $vmatricula, $UN_SALTO Rey: $vrey, $UN_SALTO Ultima inspección: $vinspeccion, $UN_SALTO N° Socio: $vnumsocio, $UN_SALTO Nombre socio: $vnombresocio, $UN_SALTO Apellido socio: $vapellidosocio, $UN_SALTO Telefono: $vtelsocio, $UN_SALTO Mail: $vmailsocio, $UN_SALTO Celular: $vcelusocio, $UN_SALTO";
										
									//set it to writable location, a place for temp generated PNG files
									$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

									//html PNG location prefix
									$PNG_WEB_DIR = 'temp/';

									include "qrlib.php";    

									//ofcourse we need rights to create temp dir
									if (!file_exists($PNG_TEMP_DIR))
										mkdir($PNG_TEMP_DIR);

									$filename = $PNG_TEMP_DIR.'test.png';

									$matrixPointSize = 10;
									$errorCorrectionLevel = 'L';

									$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
									QRcode::png($todojunto, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 

									echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';
									}
									?>
								</div>
							</div>
						</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
            function imprimir() {
                if (window.print) {
                    window.print();
                } else {
                    alert("La función de impresion no esta soportada por su navegador.");
                }
				window.close();
            }
    </script>
</body>
</html>