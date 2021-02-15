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

	if($_SESSION['tipo'] != 'Presidente'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}
	
	$accion = $_REQUEST['accion'];
	$ids = $_REQUEST['ids'];
	$accion = $_REQUEST['accion'];
	
	if ($accion =="evaluar")
			{
				$resp = mysql_query("SELECT s.id as id, s.nsocio as nsocio, s.nombre as nombre, s.apellido as apellido, s.localidadnacimiento as localidadnacimiento, 
				s.fechanacimiento as fechanacimiento, s.dni as dni, s.estadocivil as estadocivil, s.sexo as sexo, s.domicilio as domicilio, s.barrio as barrio, 
				s.localidad_id as localidad_id, s.cp as cp, s.telefono as telefono, s.celular as celular, s.email as email, s.formadepago as formadepago, 
				s.domiciliocobrador as domiciliocobrador, s.barriocobrador as barriocobrador, s.localidad_idcobrador as localidad_idcobrador, s.zona_id as zona_id, 
				s.libro as libro, s.acta as acta, s.tipo as tipo, s.categoria_id as categoria_id, s.estadoembarcadero as estadoembarcadero, s.estado as estado, 
				l.id as idlocalidad, l.descripcion as descripcion, l2.id as idlocalidad2, l2.descripcion as descripcion2, l3.id as idlocalidad3, l3.descripcion as descripcion3, 
				l4.descripcion as descripcion4, so.tipo as tiposol, so.observacion as observacion, c.ocupacion as ocupacion, c.domicilio as domicilioc, c.barrio as barrioc, 
				c.localidad_id as localidadc, z.id as idzona, z.descripcion as desczona, cat.id as catid, cat.descripcion as desccat FROM socios s 
				INNER JOIN sociosc c ON s.id = c.socio_id INNER JOIN solicitudes so ON s.id = so.socio_id INNER JOIN localidades l ON l.id = s.localidadnacimiento 
				INNER JOIN localidades l2 ON l2.id = s.localidad_id INNER JOIN localidades l3 ON l3.id = s.localidad_idcobrador 
				INNER JOIN localidades l4 ON l4.id = c.localidad_id INNER JOIN zonas z ON z.id = s.zona_id INNER JOIN categorias cat ON cat.id = s.categoria_id WHERE s.id = '$ids'");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="evaluar";
					$vnumsocio = $datos['nsocio'];
					$vnombre = $datos['nombre'];
					$vapellido = $datos['apellido'];
					$vnacidoen = $datos['provinciaid'];
					$vlocalidad = $datos['descripcion'];	
					$vfechanac = $datos['fechanacimiento'];
					$vdni = $datos['dni'];
					$vestadocivil = $datos['estadocivil'];
					$vsexo = $datos['sexo'];
					$vcalle = $datos['domicilio'];
					$vbarrio = $datos['barrio'];
					$vviveen = $datos['provinciaid2'];
					$vlocalidadviveen = $datos['descripcion2'];
					$vcpostal = $datos['cp'];
					$vtelefono = $datos['telefono'];
					$vcelular = $datos['celular'];
					$vemail = $datos['email'];
					$vformapago = $datos['formadepago'];
					$vdomicobrador = $datos['domiciliocobrador'];
					$vbarriocobrador = $datos['barriocobrador'];
					$vprovcobrador = $datos['provinciaid3'];
					$vlocalidadcobra = $datos['descripcion3'];
					$vzona = $datos['desczona'];
					$vlibro = $datos['libro'];
					$vacta = $datos['acta'];
					$vtipo = $datos['tipo'];
					$vcategorias = $datos['desccat'];
					$vembarca = $datos['estadoembarcadero'];
					$vocupacion = $datos['ocupacion'];
					$vdomiciocupa = $datos['domicilioc'];
					$vbarrioocupa = $datos['barrioc'];
					$vprovocupa = $datos['provinciaid4'];
					$vlocalidadocupa = $datos['descripcion4'];
					$vtiposol = $datos['tiposol'];
					$vobserva = $datos['observacion'];
					$vidaltausuario = $datos['usuariocarga'];
				}
			}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon"  href="img/670df58df5a2ec63b0a33e054418105a.ico"/>
	<link rel="icon" href="670df58df5a2ec63b0a33e054418105a.ico">
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
	<!-- Switch Butoom -->
	<link href="css/bootstrap-switch.css" rel="stylesheet">
	<link href="css/chosen.min.css" rel="stylesheet">
	<!-- menu lateral -->
	<link href="css/noticiasstyle.css" rel="stylesheet">
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
					<h2><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Evaluar solicitud civil</h2>
					<br><br><br>
					<form id="frmcarga" name="frmcarga" method="post" action="evaluarsolicitudes_post.php">
						<div class="table-responsive">
						<h3>Tipo de socio: <span class="label label-primary"><?php echo $vtipo;?></span></h3><hr>
						<h3>N° socio: <span class="label label-primary"><?php echo $vnumsocio;?></span></h3><hr>
						<h3>Nombre: <span class="label label-primary"><?php echo $vnombre;?></span></h3><hr>
						<h3>Apellido: <span class="label label-primary"><?php echo $vapellido;?></span></h3><hr>
						<h3>Localidad de nacimiento: <span class="label label-primary"><?php echo $vlocalidad;?></span></h3><hr>
						<h3>Fecha de nacimiento: <span class="label label-primary"><?php echo $vfechanac;?></span></h3><hr>
						<h3>DNI: <span class="label label-primary"><?php echo $vdni;?></span></h3><hr>
						<h3>Estado civil: <span class="label label-primary"><?php echo $vestadocivil;?></span></h3><hr>
						<h3>Sexo: <span class="label label-primary"><?php echo $vsexo;?></span></h3><hr>
						<h3>Domicilio: <span class="label label-primary"><?php echo $vcalle;?></span></h3><hr>
						<h3>Barrio: <span class="label label-primary"><?php echo $vbarrio;?></span></h3><hr>
						<h3>Localidad actual: <span class="label label-primary"><?php echo $vlocalidadviveen;?></span></h3><hr>
						<h3>Codigo postal: <span class="label label-primary"><?php echo $vcpostal;?></span></h3><hr>
						<h3>Teléfono: <span class="label label-primary"><?php echo $vtelefono;?></span></h3><hr>
						<h3>Celular: <span class="label label-primary"><?php echo $vcelular;?></span></h3><hr>
						<h3>Email: <span class="label label-primary"><?php echo $vemail;?></span></h3><hr>
						<h3>Forma de pago: <span class="label label-primary"><?php echo $vformapago;?></span></h3><hr>
						<h3>Domicilio cobrador: <span class="label label-primary"><?php echo $vdomicobrador;?></span></h3><hr>
						<h3>Barrio cobrador: <span class="label label-primary"><?php echo $vbarriocobrador;?></span></h3><hr>
						<h3>Localidad cobrador: <span class="label label-primary"><?php echo $vlocalidadcobra;?></span></h3><hr>
						<h3>Zona: <span class="label label-primary"><?php echo $vzona;?></span></h3><hr>
						<h3>Libro: <span class="label label-primary"><?php echo $vlibro;?></span></h3><hr>
						<h3>Acta: <span class="label label-primary"><?php echo $vacta;?></span></h3><hr>
						<h3>Categoría: <span class="label label-primary"><?php echo $vcategorias;?></span></h3><hr>
						<h3>Embarcadero: <span class="label label-primary"><?php echo $vembarca;?></span></h3><hr>
						<h3>Ocupación: <span class="label label-primary"><?php echo $vocupacion;?></span></h3><hr>
						<h3>Domicilio ocupación: <span class="label label-primary"><?php echo $vdomiciocupa;?></span></h3><hr>
						<h3>Barrio ocupación: <span class="label label-primary"><?php echo $vbarrioocupa;?></span></h3><hr>
						<h3>Localidad ocupación: <span class="label label-primary"><?php echo $vlocalidadocupa;?></span></h3>
						<?php
							if ($vtiposol == 'Egreso'){
									?>
									<hr>
									<h3>Observación: <span class="label label-primary"><?php echo $vobserva;?></span></h3>
									<?php
								} else{
									
								}
						?>
						</div><hr>
						<div class="col-sm-12">	
							<input type="checkbox" name="my-checkbox" id="my-checkbox" value="<?php echo $vaprueba;?>" data-label-text="Aprueba" >
						</div><br><br><br>
						<div class="col-sm-12">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Observación (opcional):</label>
							<textarea class="form-control" rows="5" style="overflow:auto;resize:none" name="observacion" id="observacion" placeholder="Introduce una observacion" value="<?php echo $vobservacion;?>"></textarea>
						</div><br><br><br>
						<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="ids" name="ids" value="<?php echo $ids;?>" />
						<input type="hidden" id="numerosocio" name="numerosocio" value="<?php echo $vnumsocio;?>" />
						<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
						<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Guardar" ><br><br><br>
						</div>
						<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['id']; ?>">
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
				</div>
				 
			</div>
			<br>
			<br>
			<br><br><br><br>
		</div>

		<div class="col-md-1 col-lg-1 col-xs-12 col-sm-12">
		</div>
	</div>
</div>
	<!-- /#wrapper -->
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Switch Butoom -->
	<script src="js/highlight.js"></script>
	<script src="js/bootstrap-switch.js"></script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				document.getElementById('frmcarga').submit();
			});
	</script>
	<script type="text/javascript">
			$("[name='my-checkbox']").bootstrapSwitch();
	</script>
</body>
</html>