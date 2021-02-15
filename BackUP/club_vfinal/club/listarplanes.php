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
	
	if($_SESSION['tipo'] != 'Secretario' AND $_SESSION['tipo'] != 'SA'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}

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
	<link href="css/noticiasstyle.css" rel="stylesheet">
	<!-- foto perfil -->
	<link href="css/fileinput.min.css" rel="stylesheet">
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">-->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<form>
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
					<h2>Consulta de plan vigente</h2>
					<br>
						Referencia:<br>
						<span class="label label-success"><span class="glyphicon glyphicon-eye-open" aria-hidden="false"></span> Ver familiares</span>&nbsp;<span class="label label-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="false"></span> Agregar familiar</span>&nbsp;<span class="label label-info"><span class="glyphicon glyphicon-credit-card" aria-hidden="false"></span> Imprimir carnet</span>
						<br><br>
						<div id='resultado' class="table-responsive">
						 <table class="table table-striped table-bordered">
							<tr>
							<th class="success text-center">Plan</th>
							<th class="success text-center">Detalle</th>
							<th class="success text-center">Cant. familiares</th>
							<th class="success text-center">Meses</th>
							<th class="success text-center">Vencimiento</th>
							<th class="success text-center">Ver familiares</th>
							<th class="success text-center">Agregar familiar</th>
							<th class="success text-center">Imprimir</th>
							</tr>						
							<?php 
								$accion = $_REQUEST['accion'];
								$idu = $_REQUEST['idu'];
								$usrtarget = $_SESSION['usuario'];
								$elsql="SELECT ps.id as idplan, ps.socio_id as idsocio, p.descripcion, p.detalle, p.cantidad_familiar, p.meses, ps.vencimiento 
								FROM plan_socio ps inner join planes p on p.id = ps.plan_id WHERE socio_id = '$idu' and vencimiento >= date(now())";
								$select = mysql_query($elsql); 
							// echo $elsql;
								while($datos = mysql_fetch_array($select)) {
								$idplan = $datos['idplan'];
								$elsql2="select COUNT(id) as c from plan_socio_familiar where plan_socio_id = '$idplan' and estado = 'Activo'";
								$select2 = mysql_query($elsql2); 
								while($datos2 = mysql_fetch_array($select2)) {
									$contador = $datos2['c'];
								};
								?>
								<tr>
									<td class="text-center"><?php echo $datos['descripcion'];?></td>
									<td class="text-center"><?php echo $datos['detalle'];?></td>
									<td class="text-center"><?php echo $datos['cantidad_familiar'];?></td>
									<td class="text-center"><?php echo $datos['meses'];?></td>
									<td class="text-center"><?php echo $datos['vencimiento'];?></td>
									</td>
									<td class="text-center">
									<span class="label label-success text-center">
									<a href="listarfamiliaresplan.php?accion=buscar&ids=<?php echo $datos['idplan'];?>&close=dor">
									<font color=white><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></font></a>
									</span>
									</td>
									<td class="text-center">
									<?php 
									if ($contador >= $datos['cantidad_familiar']){
										?>
											<span class="label label-danger text-center">
											<font color=white>Limite de familiares</font></a>
											</span>
										<?php
									}else{
										?>
											<span class="label label-primary text-center">
											<a href="registrarfamiliarplancuota.php?accion=buscar&ids=<?php echo $datos['idplan'];?>&close=dor">
											<font color=white><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></font></a>
											</span>
										<?php
									}
									?>
									</td>
									<td class="text-center">
									<span class="label label-info text-center">
									<a href="buscarimprimircarnet.php?accion=imprimir&idf=<?php echo $datos['idplan'];?>&close=dor" target="_blank">
									<font color=white><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></font></a>
									</span>
									</td>
								</tr>
								<?php
								} ;
							?>
						</table>
						</div>
						<br>
						<hr>
						<h2>Consulta de planes caducados</h2>	
						<br>
						<div id='resultado2' class="table-responsive">
						 <table class="table table-striped table-bordered">
							<tr>
							<th class="success text-center">Plan</th>
							<th class="success text-center">Detalle</th>
							<th class="success text-center">Cant. familiares</th>
							<th class="success text-center">Meses</th>
							<th class="success text-center">Vencimiento</th>
							</tr>						
							<?php 
								$acciones = $_REQUEST['accion'];
								$idus = $_REQUEST['idu'];
								$usrtargets = $_SESSION['usuario'];
								$elsqls="SELECT ps.id as idplan, p.descripcion, p.detalle, p.cantidad_familiar, p.meses, ps.vencimiento FROM plan_socio ps inner join planes p on p.id = ps.plan_id 
								WHERE socio_id = '$idus' and vencimiento < date(now())";
								$selects = mysql_query($elsqls); 
							// echo $elsql;
								while($dato = mysql_fetch_array($selects)) {	
								?>
								<tr>
									<td class="text-center"><?php echo $dato['descripcion'];?></td>
									<td class="text-center"><?php echo $dato['detalle'];?></td>
									<td class="text-center"><?php echo $dato['cantidad_familiar'];?></td>
									<td class="text-center"><?php echo $dato['meses'];?></td>
									<td class="text-center"><?php echo $dato['vencimiento'];?></td>
								</tr>
								<?php
								} ;
							?>
						</table>
						</div>						
				 </div>
				 
			</div>
			
			<br>
			<br>
			
		</div>
		
		<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
		</div>
</form>
		 
	</div>
</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
</body>
</html>