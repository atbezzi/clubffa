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
	include_once 'inc/conexion.php';
	
	error_reporting (0); //ocultar "notice"
	
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	
	if($_SESSION['tipo'] != 'Tesorero'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$idu = $_REQUEST['idu'];
	$queryusuario="select p.id as maxid, p.importetotal as importetotal, p.recibo as recibo, DATE_FORMAT(p.fechapago,'%d/%m/%Y') as fechapago, p.socio_id as idsocio, s.nsocio as numsocio, 
	s.nombre as nombre, s.apellido as apellido from pagos p inner join socios s on p.socio_id = s.id order by p.id desc limit 1";
	$resp = mysql_query($queryusuario);
	while($datos = mysql_fetch_array($resp)) {
	$elmaximo = $datos['maxid'];
	$vrecibo = $datos['recibo'];
	$vfecha = $datos['fechapago'];
	$vtotal = $datos['importetotal'];
	$vnumsocio = $datos['numsocio'];
	$vnombre = $datos['nombre'];
	$vapellido = $datos['apellido'];
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon"  href="img\club.ico"/>
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
<header>
	<div class="text-center">
		<img class="img" src="img\enca.jpg">
	</div>
</header>

<div id="container">
	<div class="visible-xs" style="height:70px;"></div>
	<div class="visible-sm" style="height:30px;"></div>
	<div class="row" style="max-width:100%; margin-left:0px; margin-right:0px;">
		<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
		</div>
		<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
			<div class="main1">
				<div class="content">
					<div class="text-right"><h3>Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°&nbsp;<?php echo $vrecibo;?></h3></div>
					<div class="text-left"><h4>Fecha de pago:&nbsp;<?php echo $vfecha;?></h4></div>
					<div class="text-left"><h4>N° de socio:&nbsp;<?php echo $vnumsocio;?>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Apellido y nombre:&nbsp;<?php echo $vapellido.", ".$vnombre;?></h4></div>
					<div class="text-left"><h4>Concepto:&nbsp;</h4></div>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="reportedeingresos_post.php">
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">
									<div class="table-responsive">
										<table class="table table-striped table-bordered">
											<tr>							
											<th class="success text-center">Periodo</th>
											<th class="success text-center">Cuota</th>
											<th class="success text-center">Detalle</th>
											<th class="success text-center">Importe</th>
											</tr>						
											<?php
											$qhacemos="nuevo";
											$idu= $_REQUEST['idu'];
											$accion = $_REQUEST['accion'];
											
											
											if ($accion =="imprimir")

													$elsql="select DATE_FORMAT(p.periodo,'%d/%m/%Y') as periodo, p.cuota as cuota, p.detalle as detalle, p.importe as importe from pago_detalle p 
													inner join pagos pa on pa.id = p.pago_id where p.pago_id = '$elmaximo'";
													$select = mysql_query($elsql); 
													// echo $elsql;
													while($datos = mysql_fetch_array($select)) {	
													?>
													<tr>
														<td class="text-center"><?php echo $datos['periodo'];?></td>
														<td class="text-center"><?php echo $datos['cuota'];?></td>
														<td class="text-center"><?php echo $datos['detalle'];?></td>
														<td class="text-right"><?php echo "$ ".$datos['importe'];?></td>
													</tr>
													<?php
													} ;
												
											?>
										</table>
									</div>
									<div class="text-right">
									<label for="title" class="control-label">Importe total: $</label><label id="totales" for="title" class="control-label"><?php echo $vtotal; ?></label><br><br><br><br>
									------------------------<br>
									Firma del socio<br><br>
									Aclaración<br>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
				</div>
			</div>
			<br><br>
		</div>
	</div>
	<br><br>
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