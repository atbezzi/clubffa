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
	
	if($_SESSION['tipo'] != 'Secretario'){
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
					<h2>&nbsp;Reportes</h2>
					<br>
					Referencia:<br>
					<span class="label label-primary"><span class="glyphicon glyphicon-print" aria-hidden="false"></span> Imprimir</span>
					<br><br>
					<form id="frmcarga" name="frmcarga" method="post" action="reportedeingresos_post.php">
						<!-- Grafio 1 ------------------------------------------------------------------------------------------- -->
						<div class="alert alert-success" role="alert"><strong>Cantidad de socios civiles</strong></div>
					<table class="table table-striped table-bordered">
						<tr>							
						<th class="success text-center">Categoría</th>
						<th class="success text-center">Cantidad</th>
						<th class="success text-center">Acciones</th>
						</tr>						
						<?php 
							$usrtarget = $_SESSION['usuario'];
							$elsql="SELECT c.descripcion as descripcion, COUNT(s.id) as cantidad FROM categorias c inner join socios s on s.categoria_id = c.id 
							WHERE c.tipo = 'Civil' and s.estado = 'Activo' GROUP BY descripcion";
							$select = mysql_query($elsql); 
						// echo $elsql;
							while($datos = mysql_fetch_array($select)) {	
							?>
							<tr>
								<td class="text-center"><?php echo $datos['descripcion'];?></td>
								<td class="text-center"><?php echo $datos['cantidad'];?></td>
								<td class="text-center">
								<span class="label label-primary text-center">
								<a href="buscarimprimircat.php?accion=imprimir&idp=<?php echo $datos['descripcion'];?>&close=dor" target="_blank">
								<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
								</span>
								</td>
							</tr>
							<?php
							} ;
						?>
					</table>
						<?php
						$iiac = 0;
						$respc = mysql_query("SELECT c.descripcion as descripcion, COUNT(s.id) as cantidad FROM categorias c inner join socios s on s.categoria_id = c.id 
						WHERE c.tipo = 'Civil' and s.estado = 'Activo' GROUP BY descripcion");
						while($datosc = mysql_fetch_array($respc)) {
							$array_tipoc[$iiac]= $datosc['descripcion'];
							$array_cantc[$iiac]= $datosc['cantidad'];
							$iiac = $iiac + 1;
						}
						?>
						<div id="containergraficosc"></div>
						<!-- Grafio 2 ------------------------------------------------------------------------------------------- -->
						<div class="alert alert-success" role="alert"><strong>Cantidad de socios militares</strong></div>
					<table class="table table-striped table-bordered">
						<tr>							
						<th class="success text-center">Categoría</th>
						<th class="success text-center">Cantidad</th>
						<th class="success text-center">Acciones</th>
						</tr>						
						<?php 
							$usrtarget = $_SESSION['usuario'];
							$elsql="SELECT c.descripcion as descripcion, COUNT(s.id) as cantidad FROM categorias c inner join socios s on s.categoria_id = c.id 
							WHERE c.tipo = 'Militar' and s.estado = 'Activo' GROUP BY descripcion";
							$select = mysql_query($elsql); 
						// echo $elsql;
							while($datos = mysql_fetch_array($select)) {	
							?>
							<tr>
								<td class="text-center"><?php echo $datos['descripcion'];?></td>
								<td class="text-center"><?php echo $datos['cantidad'];?></td>
								<td class="text-center">
								<span class="label label-primary text-center">
								<a href="buscarimprimircat.php?accion=imprimir&idp=<?php echo $datos['descripcion'];?>&close=dor" target="_blank">
								<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
								</span>
								</td>
							</tr>
							<?php
							} ;
						?>
					</table>
						<?php
						$iiam = 0;
						$resm = mysql_query("SELECT c.descripcion as descripcion, COUNT(s.id) as cantidad FROM categorias c inner join socios s on s.categoria_id = c.id 
						WHERE c.tipo = 'Militar' and s.estado = 'Activo' GROUP BY descripcion");
						while($datosm = mysql_fetch_array($resm)) {
							$array_tipom[$iiam]= $datosm['descripcion'];
							$array_cantm[$iiam]= $datosm['cantidad'];
							$iiam = $iiam + 1;
						}
						?>
						<div id="containergraficosm"></div>
						<!-- Grafio 3 ------------------------------------------------------------------------------------------- -->
						<div class="alert alert-success" role="alert"><strong>Cantidad de socios pensionistas</strong></div>
					<table class="table table-striped table-bordered">
						<tr>							
						<th class="success text-center">Categoría</th>
						<th class="success text-center">Cantidad</th>
						<th class="success text-center">Acciones</th>
						</tr>						
						<?php 
							$usrtarget = $_SESSION['usuario'];
							$elsql="SELECT c.descripcion as descripcion, COUNT(s.id) as cantidad FROM categorias c inner join socios s on s.categoria_id = c.id 
							WHERE c.tipo = 'Pensionista' and s.estado = 'Activo' GROUP BY descripcion";
							$select = mysql_query($elsql); 
						// echo $elsql;
							while($datos = mysql_fetch_array($select)) {	
							?>
							<tr>
								<td class="text-center"><?php echo $datos['descripcion'];?></td>
								<td class="text-center"><?php echo $datos['cantidad'];?></td>
								<td class="text-center">
								<span class="label label-primary text-center">
								<a href="buscarimprimircat.php?accion=imprimir&idp=<?php echo $datos['descripcion'];?>&close=dor" target="_blank">
								<font color=white><span class="glyphicon glyphicon-print" aria-hidden="true"></span></font></a>
								</span>
								</td>
							</tr>
							<?php
							} ;
						?>
					</table>
						<?php
						$iiap = 0;
						$resp = mysql_query("SELECT c.descripcion as descripcion, COUNT(s.id) as cantidad FROM categorias c inner join socios s on s.categoria_id = c.id 
						WHERE c.tipo = 'Pensionista' and s.estado = 'Activo' GROUP BY descripcion");
						while($datosp = mysql_fetch_array($resp)) {
							$array_tipop[$iiap]= $datosp['descripcion'];
							$array_cantp[$iiap]= $datosp['cantidad'];
							$iiap = $iiap + 1;
						}
						?>
									<div id="containergraficosp"></div>
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
	Highcharts.chart('containergraficosc', {
		chart: {
			type: 'pie',
			options3d: {
				enabled: true,
				alpha: 45,
				beta: 0
			}
		},
		title: {
			text: ''
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					format: '{point.name}'
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Porcentaje',
			data: [
			<?php for ($key_Number = 0; $key_Number <= $iiac; $key_Number++) {
					print "['".$array_tipoc[$key_Number]."',".$array_cantc[$key_Number]."],";
}?>
			]
		}]
	});
	</script>
	<script type="text/javascript">
	Highcharts.chart('containergraficosm', {
		chart: {
			type: 'pie',
			options3d: {
				enabled: true,
				alpha: 45,
				beta: 0
			}
		},
		title: {
			text: ''
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					format: '{point.name}'
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Porcentaje',
			data: [
			<?php for ($key_Number = 0; $key_Number <= $iiam; $key_Number++) {
					print "['".$array_tipom[$key_Number]."',".$array_cantm[$key_Number]."],";
}?>
			]
		}]
	});
	</script>
	<script type="text/javascript">
	Highcharts.chart('containergraficosp', {
		chart: {
			type: 'pie',
			options3d: {
				enabled: true,
				alpha: 45,
				beta: 0
			}
		},
		title: {
			text: ''
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				depth: 35,
				dataLabels: {
					enabled: true,
					format: '{point.name}'
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Porcentaje',
			data: [
			<?php for ($key_Number = 0; $key_Number <= $iiap; $key_Number++) {
					print "['".$array_tipop[$key_Number]."',".$array_cantp[$key_Number]."],";
}?>
			]
		}]
	});
	</script>
</body>
</html>