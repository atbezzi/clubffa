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
/*	$qhacemos="nuevo";
	$idcli= $_REQUEST['idcli'];
	$accion = $_REQUEST['accion'];
	if ($accion =="inactiva")
			{
				$add = mysql_query("update clientes set activo = 'N' where idcliente = $idcli");
				if($add){
					header("location:adminclientes.php?retorno=Inactivado correctamente");
				}else{
					header("location:adminclientes.php?retorno=" .mysql_error());
				}
			}
	if ($accion =="modifica")
			{
				$resp = mysql_query("select * from clientes where idcliente = $idcli");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vnombre= $datos['nombrecompleto'];
					$vdni=$datos['dni'];;
					$vtel= $datos['telefono'];;
					$vmail= $datos['email'];;
				}
			}
*/?>
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
	<style type="text/css">
#containergraficos {
	min-width: 310px;
	max-width: 800px;
	height: 400px;
	margin: 0 auto
}
		</style>
</head>
<body>
<div id="container">
	<div style="position:fixed;width:100%; z-index: 10000;">
		<?php include_once "menu.php" ?>
	</div>
	<div class="visible-xs" style="height:70px;"></div>
	<div class="visible-sm" style="height:30px;"></div>
	<div class="row" style="max-width:100%; margin-left:0px; margin-right:0px;">
		<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
		</div>
		<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
			<div class="main1">
				<div class="content">
					<h2><span class="glyphicon glyphicon-signal"></span>&nbsp;Reportes</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="reportedeingresos_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
							<!-- Va algo aca -->
						</div>
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<div class="main1">
								<div class="content">
									<div class="table-responsive">
										<!-- Va algo aca -->
									</div>
								</div>
							</div>
						</div>
						<!-- grafico 1 ingresos -->
						<?php
						$resp = mysql_query("SELECT month(sol.fechaalta) as mes, sol.estado, COUNT(sol.socio_id) AS cantidad, CASE month(sol.fechaalta) when '01' then 'Enero'
when '02' then 'Febrero'
when '03' then 'Marzo'
when '04' then 'Abril'
when '05' then 'Mayo'
when '06' then 'Junio'
when '07' then 'Julio'
when '08' then 'Agosto'
when '09' then 'Septiembre'
when '10' then 'Octubre'
when '11' then 'Noviembre'
when '12' then 'Diciembre' END as nombremes FROM solicitudes sol WHERE sol.tipo = 'Ingreso' GROUP BY month(sol.fechaalta), sol.estado ORDER BY mes ASC");
						$iia = 0;
						$mes = 0;
						while($datos = mysql_fetch_array($resp)) {
							if ($mes == $datos['mes']){
								if ($datos['estado'] == 'Aprobado'){
									$array_aprobado[$iia]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'No aprobado'){
									$array_noaprobado[$iia]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'Pendiente'){
									$array_pendiente[$iia]= $datos['cantidad'];
								}
							}else{
								if($mes > 0){
									$iia = $iia + 1;
								}
								$mes = $datos['mes'];
								$array_meses[$iia] = $datos['nombremes'];
								if ($datos['estado'] == "Aprobado"){
									$array_aprobado[$iia]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'No aprobado'){
									$array_noaprobado[$iia]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'Pendiente'){
									$array_pendiente[$iia]= $datos['cantidad'];
								}
							}
						}
						?>
						<!-- grafico 2 egresos -->
						<?php
						$resp = mysql_query("SELECT month(sol.fechaalta) as mes, sol.estado, COUNT(sol.socio_id) AS cantidad, CASE month(sol.fechaalta) when '01' then 'Enero'
when '02' then 'Febrero'
when '03' then 'Marzo'
when '04' then 'Abril'
when '05' then 'Mayo'
when '06' then 'Junio'
when '07' then 'Julio'
when '08' then 'Agosto'
when '09' then 'Septiembre'
when '10' then 'Octubre'
when '11' then 'Noviembre'
when '12' then 'Diciembre' END as nombremes FROM solicitudes sol WHERE sol.tipo = 'Egreso' GROUP BY month(sol.fechaalta), sol.estado ORDER BY mes ASC");
						$iiae = 0;
						$mese = 0;
						while($datos = mysql_fetch_array($resp)) {
							if ($mese == $datos['mes']){
								if ($datos['estado'] == 'Aprobado'){
									$array_aprobadoe[$iiae]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'No aprobado'){
									$array_noaprobadoe[$iiae]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'Pendiente'){
									$array_pendientee[$iiae]= $datos['cantidad'];
								}
							}else{
								if($mese > 0){
									$iiae = $iiae + 1;
								}
								$mese = $datos['mes'];
								$array_mesese[$iiae] = $datos['nombremes'];
								if ($datos['estado'] == "Aprobado"){
									$array_aprobadoe[$iiae]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'No aprobado'){
									$array_noaprobadoe[$iiae]= $datos['cantidad'];
								}
								if ($datos['estado'] == 'Pendiente'){
									$array_pendientee[$iiae]= $datos['cantidad'];
								}
							}
						}
						?>
									<div id="containergraficos"></div><br>
									<div id="containergraficos2"></div>
				</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
			</div>
			<br><br>
		</div>
	</div>
	<br><br>
</div>
<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Grafios -->
	<script src="graficos/highcharts.js"></script>
	<script src="graficos/modules/exporting.js"></script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#fechanac').datepicker({
				format: "dd/mm/yyyy", 
				endDate: "+0d",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("codigoafi").value.trim() != ""){
					if(document.getElementById("fechanac").value.trim() != ""){
						if(document.getElementById("recibo").value.trim() != ""){							
							if(document.getElementById("formpago").value.trim() != 0){
								document.getElementById('frmcarga').submit();
							}else{
								alert("Debe seleccionar el tipo de solicitud");
							}
						}else{
							alert("Debe ingresar un recibo");
						}
					}else{
						alert("Debe ingresar una fecha de pago");
					}
				}else{
						alert("Debe ingresar un codigo de afiliado");
					}
			});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#buscar', function(event) {
				if(document.getElementById("fechanac").value.trim() != 0){
					document.getElementById('frmcarga').submit();
				}else{
					alert("Debe ingresar una fecha valida");
				}
			});
	</script>
	<script type="text/javascript">
		function validarNumeros(e) { // 1
		
		tecla = (document.all) ? e.keyCode : e.which; // 2
		
		if (tecla==8) return true; // backspace
			if (tecla==9) return true; // backspace
			if (tecla==110) return true; // punto
		if (e.ctrlKey && tecla==86) { return true}; //Ctrl v
		if (e.ctrlKey && tecla==67) { return true}; //Ctrl c
		if (e.ctrlKey && tecla==88) { return true}; //Ctrl x
		if (tecla>=96 && tecla<=105) { return true;} //numpad
		 
		patron = /[0-9]/; // patron
		 
		te = String.fromCharCode(tecla);
		return patron.test(te); // prueba
		}
	</script>
	<script type="text/javascript">
	Highcharts.chart('containergraficos', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Movimiento de socios mensuales (ingresos)'
		},
		subtitle: {
			text: 'CFFAA CBA'
		},
		xAxis: {
			categories: [
				<?php for ($key_Number = 0; $key_Number <= $iia; $key_Number++) {

									print "'".$array_meses[$key_Number]."',";

}?>
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'N° Socios'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y} </b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: 'Aprobados',
			data: [<?php for ($key_Number = 0; $key_Number <= $iia; $key_Number++) {
								if($array_aprobado[$key_Number] == ""){
									print "0,";
								}else{
									print "".$array_aprobado[$key_Number].",";
								}
}?>]

		}, {
			name: 'No Aprobados',
			data: [<?php for ($key_Number = 0; $key_Number <= $iia; $key_Number++) {
								if($array_noaprobado[$key_Number] == ""){
									print "0,";
								}else{
									print "".$array_noaprobado[$key_Number].",";
								}
}?>]

		},{
			name: 'Pendientes',
			data: [<?php for ($key_Number = 0; $key_Number <= $iia; $key_Number++) {
								if($array_pendiente[$key_Number] == ""){
									print "0,";
								}else{
									print "".$array_pendiente[$key_Number].",";
								}
}?>]

		}]
	});
	</script>
	<script type="text/javascript">
	Highcharts.chart('containergraficos2', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Movimiento de socios mensuales (egresos)'
		},
		subtitle: {
			text: 'CFFAA CBA'
		},
		xAxis: {
			categories: [
				<?php for ($key_Number = 0; $key_Number <= $iiae; $key_Number++) {

									print "'".$array_mesese[$key_Number]."',";

}?>
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'N° Socios'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y} cant</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: 'Aprobados',
			data: [<?php for ($key_Number = 0; $key_Number <= $iiae; $key_Number++) {
								if($array_aprobadoe[$key_Number] == ""){
									print "0,";
								}else{
									print "".$array_aprobadoe[$key_Number].",";
								}
}?>]

		}, {
			name: 'No Aprobados',
			data: [<?php for ($key_Number = 0; $key_Number <= $iiae; $key_Number++) {
								if($array_noaprobadoe[$key_Number] == ""){
									print "0,";
								}else{
									print "".$array_noaprobadoe[$key_Number].",";
								}
}?>]

		},{
			name: 'Pendientes',
			data: [<?php for ($key_Number = 0; $key_Number <= $iiae; $key_Number++) {
								if($array_pendientee[$key_Number] == ""){
									print "0,";
								}else{
									print "".$array_pendientee[$key_Number].",";
								}
}?>]

		}]
	});
	</script>
</body>
</html>