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
	
	if($_SESSION['tipo'] != 'Secretario'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	
	$qhacemos = "nuevo";
	$idu = $_REQUEST['idu'];
	$accion = $_REQUEST['accion'];
	
	if ($accion =="modifica")
			{
				$resp = mysql_query("SELECT s.id as idsocio, s.nsocio as numsocio, s.nombre as nombre, s.apellido as apellido, 
					s.localidadnacimiento as localidadnacimiento, s.fechanacimiento as fechanac, s.dni as dni, s.estadocivil as estadocivil, 
					s.sexo as sexo, s.domicilio as domicilio, s.barrio as barrio, s.localidad_id as localidadviveen, s.cp as cp, s.telefono as telefono, 
					s.celular as celular, s.email as email, s.formadepago as formadepago, s.domiciliocobrador as domiciliocobrador, 
					s.localidad_idcobrador as localidad_idcobrador, s.zona_id as zona_id, s.libro as libro, s.acta as acta, s.tipo as tipo, 
					s.categoria_id as categoria_id, s.estadoembarcadero as estadoembarcadero, s.estado as estado, c.id as idsocioc, c.socio_id as socioc, 
					c.ocupacion as ocupacion, c.domicilio as domicilioc, c.barrio as barrioc, c.localidad_id as localidadc, c.estado as estadoc, 
					p.id as provinciaid, p2.id as provinciaid2, p3.id as provinciaid3, p4.id as provinciaid4 FROM socios s 
					INNER JOIN sociosc c ON s.id = c.socio_id 
					INNER JOIN localidades l ON l.id = s.localidadnacimiento 
					INNER JOIN provincias p ON p.id = l.provincia_id INNER JOIN localidades l2 ON l2.id = s.localidad_id 
					INNER JOIN provincias p2 ON p2.id = l2.provincia_id INNER JOIN localidades l3 ON l3.id = s.localidad_idcobrador 
					INNER JOIN provincias p3 ON p3.id = l3.provincia_id INNER JOIN localidades l4 ON l4.id = c.localidad_id 
					INNER JOIN provincias p4 ON p4.id = l4.provincia_id WHERE s.id = $idu");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vfoto = $datos['avatar-2'];
					$vnumsocio = $datos['numsocio'];
					$vnombre = $datos['nombre'];
					$vapellido = $datos['apellido'];
					$vnacidoen = $datos['provinciaid'];
					$vlocalidad = $datos['localidadnacimiento'];	
					$vfechanac = $datos['fechanac'];
					$vdni = $datos['dni'];
					$vestadocivil = $datos['estadocivil'];
					$vsexo = $datos['sexo'];
					$vcalle = $datos['domicilio'];
					$vbarrio = $datos['barrio'];
					$vviveen = $datos['provinciaid2'];
					$vlocalidadviveen = $datos['localidadviveen'];
					$vcpostal = $datos['cp'];
					$vtelefono = $datos['telefono'];
					$vcelular = $datos['celular'];
					$vemail = $datos['email'];
					$vformapago = $datos['formadepago'];
					$vdomicobrador = $datos['domiciliocobrador'];
					$vbarriocobrador = $datos['barrioc'];
					$vprovcobrador = $datos['provinciaid3'];
					$vlocalidadcobra = $datos['localidad_idcobrador'];
					$vzona = $datos['zona_id'];
					$vlibro = $datos['libro'];
					$vacta = $datos['acta'];
					$vcategorias = $datos['categoria_id'];
					$vembarca = $datos['estadoembarcadero'];
					$vocupacion = $datos['ocupacion'];
					$vdomiciocupa = $datos['domicilioc'];
					$vbarrioocupa = $datos['barrioc'];
					$vprovocupa = $datos['provinciaid4'];
					$vlocalidadocupa = $datos['localidadc'];
					$vidaltausuario = $datos['usuariocarga'];
				}
			}
			//echo "------------------------------------------------------------hola=".$vlocalidadviveen;
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
	<!-- foto perfil -->
	<link href="css/fileinput.min.css" rel="stylesheet">
	<!-- datetimepicker -->
	<link href="css/datepicker.css" rel="stylesheet">
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Carga de Afiliados Civil</h2>
					<hr>
					<form id="frmcarga" name="frmcarga" method="post" action="modificarformularioscivil_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-camera"></span>&nbsp;Foto de Perfil:</label>
						<div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
						<div class="kv-avatar center-block" style="width:200px">
							<input id="avatar-2" name="avatar-2" type="file" class="file-loading" value="<?php echo $vfoto;?>">
						</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Numero de Socio:</label>
							<input type="text" name="numsocio" class="form-control" id="numsocio" placeholder="Introduce un numero de socio" value="<?php echo $vnumsocio;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre:</label>
							<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Introduce un nombre" value="<?php echo $vnombre;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Apellido:</label>
							<input type="text" name="apellido" class="form-control" id="apellido" placeholder="Introduce un apellido" value="<?php echo $vapellido;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha de Nacimiento:</label>
							<input type="text" name="fechanac" class="form-control" id="fechanac" placeholder="Introduce la fecha de nacimiento" value="<?php echo $vfechanac;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;DNI:</label>
							<input type="text" name="dni" class="form-control" id="dni" onkeydown="return validarNumeros(event)" placeholder="Introduce un dni" value="<?php echo $vdni;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Estado Civil:</label>
							<div class="col-sm-12">
								<select class="form-control" name="estadocivil" id="estadocivil">
									<option value="<?php echo $vestadocivil;?>"> - <?php echo $vestadocivil;?> - </option>
									<option value="Soltero">Soltero</option>
									<option value="Casado">Casado</option>
									<option value="Viudo">Viudo</option>
									<option value="Divorciado">Divorciado</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Sexo:</label>
							<div class="col-sm-12">
								<select class="form-control" name="sexo" id="sexo">
									<option value="<?php echo $vsexo;?>"> - <?php echo $vsexo;?> - </option>
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Domicilio Completo:</label>
							<input type="text" name="calle" class="form-control" id="calle" placeholder="Introduce domicilio completo" value="<?php echo $vcalle;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Barrio:</label>
							<input type="text" name="barrio" class="form-control" id="barrio" placeholder="Introduce el nombre del barrio" value="<?php echo $vbarrio;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nacido en:</label>
							<?php
							$res=mysql_query("select * from provincias");
							?>
							<select type="text" name="nacidoen" class="form-control" id="nacidoen" placeholder="Seleccione lugar de nacimiento" onchange="loadnacido(this.value)" value="<?php echo $vnacidoen;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
								if ($vnacidoen == $fila['id']){
									$select = "selected";
								} else{
									$select = "";
								}
							?>
							<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDivNacido">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad de nacimiento:</label>
							<select type="text" name="localidad" class="form-control" id="localidad" placeholder="Seleccione la localidad" value="<?php echo $vlocalidad;?>"></select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Vive en:</label>
							<?php
							$res=mysql_query("select * from provincias");
							?>
							<select type="text" name="viveen" class="form-control" id="viveen" placeholder="Seleccione lugar de nacimiento" onchange="loadv(this.value)" value="<?php echo $vviveen;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
								if ($vviveen == $fila['id']){
									$select = "selected";
								} else{
									$select = "";
								}
							?>
							<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDivV">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad actual:</label>
							<select type="text" name="localidadviveen" class="form-control" id="localidadviveen" placeholder="Seleccione la localidad actual" value="<?php echo $vlocalidadviveen;?>"></select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Codigo Postal:</label>
							<input type="text" name="cpostal" class="form-control" id="cpostal" onkeydown="return validarNumeros(event)" placeholder="Introduce el codigo postal" value="<?php echo $vcpostal;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Telefono:</label>
							<input type="text" name="telefono" class="form-control" id="telefono" onkeydown="return validarNumeros(event)" placeholder="Introduce un numero telefonico" value="<?php echo $vtelefono;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Celular:</label>
							<input type="text" name="celular" class="form-control" id="celular" onkeydown="return validarNumeros(event)" placeholder="Introduce un numero celular" value="<?php echo $vcelular;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;E-mail:</label>
							<input type="text" name="email" class="form-control" id="email" placeholder="Introduce un correo electronico" value="<?php echo $vemail;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Forma de pago:</label>
							<div class="col-sm-12">
								<select class="form-control" name="formapago" id="formapago">
									<option value="<?php echo $vactivo;?>"> - <?php echo $vformapago;?> - </option>
									<option value="Club">Club</option>
									<option value="Cobrador">Cobrador</option>
									<option value="SMSV">SMSV</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Domicilio Cobrador:</label>
							<input type="text" name="domicobrador" class="form-control" id="domicobrador" placeholder="Introduce el nombre del barrio de cobro" value="<?php echo $vdomicobrador;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Barrio Cobrador:</label>
							<input type="text" name="barriocobrador" class="form-control" id="barriocobrador" placeholder="Introduce el nombre del barrio de cobro" value="<?php echo $vbarriocobrador;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Provincia Cobrador:</label>
							<?php
							$res=mysql_query("select * from provincias");
							?>
							<select type="text" name="provcobrador" class="form-control" id="provcobrador" placeholder="Seleccione una provincia de cobro" onchange="loadc(this.value)" value="<?php echo $vprovcobrador;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
								if ($vprovcobrador == $fila['id']){
									$select = "selected";
								} else{
									$select = "";
								}
							?>
							<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDivC">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad Cobrador:</label>
							<select type="text" name="localidadcobra" class="form-control" id="localidadcobra" placeholder="Seleccione la localidad de cobro" value="<?php echo $vlocalidadcobra;?>"></select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Zona:</label>
							<div class="col-sm-12">
								<?php
								$res=mysql_query("select * from zonas");
								?>
								<select type="text" name="zona" class="form-control" id="zona" placeholder="Selecciona una zona" value="<?php echo $vzona;?>">
								<option value="">Seleccione</option>
								<?php
								while($fila=mysql_fetch_array($res)){
									if ($vzona == $fila['id']){
										$select = "selected";
									} else{
										$select = "";
									}
								?>
								<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
								<?php }
								?>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Libro:</label>
							<input type="text" name="libro" class="form-control" id="libro" placeholder="Introduce un libro" value="<?php echo $vlibro;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Acta:</label>
							<input type="text" name="acta" class="form-control" id="acta" placeholder="Introduce un acta" value="<?php echo $vacta;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Categorias:</label>
							<div class="col-sm-12">
								<?php
								$res=mysql_query("select * from categorias where tipo = 'Civil' And estado = 'Activo'");
								?>
								<select type="text" name="categorias" class="form-control" id="categorias" placeholder="Selecciona una categorias" value="<?php echo $vcategorias;?>">
								<option value="">Seleccione</option>
								<?php
								while($fila=mysql_fetch_array($res)){
									if ($vcategorias == $fila['id']){
										$select = "selected";
									} else{
										$select = "";
									}
								?>
								<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
								<?php }
								?>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Embarcacion:</label>
							<div class="col-sm-12">
								<select class="form-control" name="embarca" id="embarca">
									<option value="<?php echo $vembarca;?>"> - <?php echo $vembarca;?> - </option>
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Ocupacion:</label>
							<input type="text" name="ocupacion" class="form-control" id="ocupacion" placeholder="Introduce una ocupacion" value="<?php echo $vocupacion;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Domicilio Ocupacion:</label>
							<input type="text" name="domiciocupa" class="form-control" id="domiciocupa" placeholder="Introduce un domicilio" value="<?php echo $vdomiciocupa;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Barrio Ocupacion:</label>
							<input type="text" name="barrioocupa" class="form-control" id="barrioocupa" placeholder="Introduce un barrio" value="<?php echo $vbarrioocupa;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Provincia Ocupacion:</label>
							<?php
							$res=mysql_query("select * from provincias");
							?>
							<select type="text" name="provocupa" class="form-control" id="provocupa" placeholder="Seleccione una provincia de cobro" onchange="loado(this.value)" value="<?php echo $vprovocupa;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
								if ($vprovocupa == $fila['id']){
									$select = "selected";
								} else{
									$select = "";
								}
							?>
							<option <?php echo $select; ?> value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDivO">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad Ocupacion:</label>
							<select type="text" name="localidadocupa" class="form-control" id="localidadocupa" placeholder="Seleccione la localidad de cobro" value="<?php echo $vlocalidadocupa;?>"></select>
						</div>
						<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="idu" name="idu" value="<?php echo $idu;?>" />
						<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
						<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Actualizar" >
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
	<script src="js/ajax.js"></script>
	<!-- jQuery -->
	<script src="js/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Menu Profile Picture -->
	<script src="js/fileinput.min.js"></script>
	<!-- Date Time Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
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
	<script>
	var btnCust = '<button type="button" class="btn btn-default" title="Etiquetas" ' + 
		'onclick="alert(\'Mensaje del servidor\')">' +
		'<i class="glyphicon glyphicon-tag"></i>' +
		'</button>'; 
	$("#avatar-2").fileinput({
		overwriteInitial: true,
		maxFileSize: 1500,
		showClose: false,
		showCaption: false,
		showBrowse: false,
		browseOnZoneClick: true,
		removeLabel: '',
		removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		removeTitle: 'Cancelar',
		elErrorContainer: '#kv-avatar-errors-2',
		msgErrorClass: 'alert alert-block alert-danger',
		defaultPreviewContent: '<img src="img/default.jpg" alt="Perfil" style="width:160px"><h6 class="text-muted">Click para seleccionar</h6>',
		layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
		allowedFileExtensions: ["jpg", "png", "gif"]
	});
	</script>
	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>
	<!-- Carga de Provincias y Localidades Selectiva Para Modificar -->
	<script type="text/javascript">
	loadmodifica(<?php echo $vnacidoen.",".$vlocalidad; ?>);
	loadmodifica2(<?php echo $vviveen.",".$vlocalidadviveen; ?>);
	loadmodifica3(<?php echo $vprovcobrador.",".$vlocalidadcobra; ?>);
	loadmodifica4(<?php echo $vprovocupa.",".$vlocalidadocupa; ?>);
	</script>
	<script type="text/javascript">
		jQuery('#frmcarga').on('click', '#cargar', function(event) {
			if(document.getElementById("numsocio").value.trim() != ""){
				if(document.getElementById("nombre").value.trim() != ""){
					 if(document.getElementById("apellido").value.trim() != ""){
						if(document.getElementById("fechanac").value.trim() != ""){
							if(document.getElementById("dni").value.trim() != ""){
								if(document.getElementById("estadocivil").value.trim() != 0){
									if(document.getElementById("sexo").value.trim() != 0){
										if(document.getElementById("calle").value.trim() != ""){
											if(document.getElementById("barrio").value.trim() != ""){
												if(document.getElementById("nacidoen").value.trim() != 0){
													if(document.getElementById("localidad").value.trim() != 0){
														if(document.getElementById("viveen").value.trim() != 0){
															if(document.getElementById("localidadviveen") != 0){
																if(document.getElementById("cpostal").value.trim() != ""){
																	if(document.getElementById("telefono").value.trim() != ""){
																		if(document.getElementById("celular").value.trim() != ""){
																			if(document.getElementById("email").value.trim() != ""){
																				if(document.getElementById("formapago").value.trim() != 0){
																					if(document.getElementById("domicobrador").value.trim() != ""){
																						if(document.getElementById("barriocobrador").value.trim() != ""){
																							if(document.getElementById("provcobrador").value.trim() != 0){
																								if(document.getElementById("localidadcobra") != 0){
																									if(document.getElementById("zona").value.trim() != 0){
																										if(document.getElementById("libro").value.trim() != ""){
																											if(document.getElementById("acta").value.trim() != ""){
																												if(document.getElementById("categorias").value.trim() != 0){
																													if(document.getElementById("embarca").value.trim() != 0){
																														if(document.getElementById("ocupacion").value.trim() != ""){
																															if(document.getElementById("domiciocupa").value.trim() != ""){
																																if(document.getElementById("barrioocupa").value.trim() != ""){
																																	if(document.getElementById("provocupa").value.trim() != 0){
																																		if(document.getElementById("localidadocupa") != 0){
																																			document.getElementById('frmcarga').submit();
																																		}else{
																																			alert("Debe seleccionar una localidad de ocupacion");
																																		}
																																	}else{
																																		alert("Debe seleccionar una provincia de ocupacion");
																																	}
																																}else{
																																	alert("Debe ingresar una barrio de ocupacion");
																																}
																															}else{
																																alert("Debe ingresar un domicilio de ocupacion");
																															}
																														}else{
																															alert("Debe seleccionar una ocupacion");
																														}
																													}else{
																													alert("Debe seleccionar si posee embarcacion");
																												}
																												}else{
																													alert("Debe seleccionar una categoria");
																												}
																											}else{
																												alert("Debe ingresar un acta");
																											}
																										}else{
																											alert("Debe ingresar un libro");
																										}
																									}else{
																										alert("Debe seleccionar una zona");
																									}
																								}else{
																									alert("Debe seleccionar una localidad de cobro");
																								}
																							}else{
																								alert("Debe seleccionar una provincia de cobro");
																							}
																						}else{
																							alert("Debe ingresar un barrio para cobrador");
																						}
																					}else{
																						alert("Debe ingresar un domicilio para cobrador");
																					}
																				}else{
																					alert("Debe seleccionar una forma de pago");
																				}
																			}else{
																				alert("Debe ingresar un email");
																			}
																		}else{
																			alert("Debe ingresar el numero de celular");
																		}
																	}else{
																		alert("Debe ingresar el numero de telefono");
																	}
																}else{
																	alert("Debe ingresar el codigo postal");
																}
															}else{
															alert("Debe seleccionar la localidad actual");
															}
														}else{
															alert("Debe seleccionar la provincia de actual");
														}
													}else{
														alert("Debe seleccionar la localidad de nacimiento");
													}
												}else{
													alert("Debe seleccionar la provincia de nacimiento");
												}
											}else{
												alert("Debe ingresar el barrio");
											}
										}else{
											alert("Debe ingresar el domicilio completo");
										}
									}else{
										alert("Debe seleccionar el sexo");
									}
								}else{
									alert("Debe seleionar un esado civil");
								}
							}else{
								alert("Debe ingresar el dni");
							}
						}else{
							alert("Debe escribir una  fecha de nacimiento");
						}
					}else{
						alert("Debe ingresar la apellido");
					}
				}else{
					alert("Debe ingresar el nombre");
				}
			}else{
				alert("Debe ingresar un numero de socio");
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
</body>
</html>