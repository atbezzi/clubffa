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
	
	if($_SESSION['tipo'] != 'Secretario' AND $_SESSION['tipo'] != 'SA'){
		header("location:index.php?retorno=no_acess");
	} else{
		
	}
	$qhacemos="nuevo";
	$ids= $_REQUEST['ids'];
	$accion = $_REQUEST['accion'];

	if ($accion =="buscar")
			{
				$resp = mysql_query("select s.nsocio, s.id as idsocio, concat(s.apellido,', ',s.nombre) as nombre, p.descripcion, p.cantidad_familiar from socios s 
				inner join plan_socio ps on ps.socio_id = s.id inner join planes p on p.id = ps.plan_id where ps.id = $ids");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos ="modifica";
					$vnombre = $datos['nombre'];
					$vnsocio = $datos['nsocio'];
					$vdescripcion = $datos['descripcion'];
					$vfamiliares = $datos['cantidad_familiar'];
					$idsocio = $datos['idsocio'];
				}
			}
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
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" type="text/css">-->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Adjuntar familiar al plan</h2>
					<hr><br>
					<form id="frmguardar" name="frmguardar" method="post" action="registrarfamiliarplancuota_post.php">
						<div id=resultado class="col-lg-12 col-md-12 form-group text-left">
						<label for="title" class="col-sm-12 control-label">&nbsp;Socio: <span class="label label-success"><?php echo $vnsocio;?>&nbsp;-&nbsp;<?php echo $vnombre;?></span></label>
						<label for="title" class="col-sm-12 control-label">&nbsp;Plan: <span class="label label-success"><?php echo $vdescripcion;?>&nbsp;-&nbsp;<?php echo $vfamiliares;?>&nbsp;Familiares</span></label>
						</div>
						<div class="col-lg-8 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Familiares:</label>
							<div class="col-sm-12">
								<?php
								$res=mysql_query("SELECT f.id as idflia, concat(f.nombre,', ',f.apellido) as nombre from familiares f 
								where f.id not in (select psf.familiar_id from plan_socio_familiar psf where psf.plan_socio_id = '$ids' and psf.estado = 'Activo') and f.socio_id = '$idsocio' and f.estado = 'Activo' group by f.id");
								?>
								<select type="text" name="parentescosocio" class="form-control" id="parentescosocio" onChange="buscarfamiliares();" placeholder="Selecciona un plan" value="<?php echo $vtipoplanes;?>">
								<option value="0">Seleccione</option>
								<?php
								while($fila=mysql_fetch_array($res)){
								?>
								<option value="<?php echo $fila['idflia']; ?>"><?php echo $fila['nombre']; ?></option>
								<?php }
								?>
								</select>
							</div>
						</div>
						<div style="padding-left:15px;padding-right:15px">
							<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
							<input type="hidden" id="ids" name="ids" value="<?php echo $ids;?>" />
							<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
							<input style="margin-top: 10px; text-align:center" id="guardar" name="guardar" type="button" class="pull-right botoncss" value="Guardar" >
							<br><br><br><br><br><br>
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
<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
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
	<script type="text/javascript">
		jQuery('#frmguardar').on('click', '#guardar', function(event) {
			if(document.getElementById("parentescosocio").value.trim() != 0){
				document.getElementById('frmguardar').submit();
			}else{
				alert("Debe seleccionar un familiar");
			}
		});
	</script>
</body>
</html>