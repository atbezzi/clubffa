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
/*	if ($accion =="inactiva")
			{
				$add = mysql_query("update clientes set activo = 'N' where idcliente = $idcli");
				if($add){
					header("location:adminclientes.php?retorno=Inactivado correctamente");
				}else{
					header("location:adminclientes.php?retorno=" .mysql_error());
				}
			}*/
	if ($accion =="modifica")
			{
				$resp = mysql_query("select * from afiliados where idafiliado = $idu");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vnombre= $datos['nombre'];
					$vdni=$datos['dni'];;
					$vapellido= $datos['apellido'];;
					$vtipo= $datos['tipo'];;
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
<body onload="deshab()">
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Carga de Afiliados Militar</h2>
					<a href="consultarformularios.php"><span class="glyphicon glyphicon-share-alt" aria-hidden="true">Volver</span></a>
					<hr>
					<form id="frmcarga" name="frmcarga" method="post" action="consultarformularios.php">
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
							<select type="text" name="nacidoen" class="form-control" id="nacidoen" placeholder="Seleccione lugar de nacimiento" onchange="load(this.value)" value="<?php echo $vnacidoen;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
							?>
							<option value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDiv">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad:</label>
							<select type="text" name="localidad" class="form-control" id="localidad" placeholder="Seleccione la localidad" value="<?php echo $vlocalidad;?>"></select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Vide en:</label>
							<?php
							$res=mysql_query("select * from provincias");
							?>
							<select type="text" name="viveen" class="form-control" id="viveen" placeholder="Seleccione lugar de nacimiento" onchange="loadv(this.value)" value="<?php echo $vviveen;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
							?>
							<option value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDivV">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad:</label>
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
							?>
							<option value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
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
								?>
								<option value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
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
								$res=mysql_query("select * from categorias where tipo = 'Militar' And estado = 'Activo'");
								?>
								<select type="text" name="categorias" class="form-control" id="categorias" placeholder="Selecciona una categorias" value="<?php echo $vcategorias;?>">
								<option value="">Seleccione</option>
								<?php
								while($fila=mysql_fetch_array($res)){
								?>
								<option value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
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
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Situacion Militar:</label>
							<div class="col-sm-12">
								<select class="form-control" name="situmilitar" id="situmilitar">
									<option value="<?php echo $vsitumilitar;?>"> - <?php echo $vsitumilitar;?> - </option>
									<option value="Activo">Activo</option>
									<option value="No activo">No activo</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Grado:</label>
							<input type="text" name="grado" class="form-control" id="grado" placeholder="Introduce un grado" value="<?php echo $vgrado;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fuerza:</label>
							<input type="text" name="fuerza" class="form-control" id="fuerza" placeholder="Introduce una fuerza" value="<?php echo $vfuerza;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Escalafon:</label>
							<input type="text" name="escalafon" class="form-control" id="escalafon" placeholder="Introduce un escalafon" value="<?php echo $vescalafon;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Promovido por:</label>
							<input type="text" name="promovidopor" class="form-control" id="promovidopor" placeholder="Introduce un promotor" value="<?php echo $vpromovidopor;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Provincia Militar:</label>
							<?php
							$res=mysql_query("select * from provincias");
							?>
							<select type="text" name="provmil" class="form-control" id="provmil" placeholder="Seleccione una provincia" onchange="loadmil(this.value)" value="<?php echo $vprovmil;?>">
							<option value="">Seleccione</option>
							<?php
							while($fila=mysql_fetch_array($res)){
							?>
							<option value="<?php echo $fila['id']; ?>"><?php echo $fila['descripcion']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDivM">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad Militar:</label>
							<select type="text" name="localidadmil" class="form-control" id="localidadmil" placeholder="Seleccione la localidad" value="<?php echo $vlocalidadmil;?>"></select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Servicio Desde:</label>
							<input type="text" name="fechaini" class="form-control" id="fechaini" placeholder="Introduce la fecha de inicio de servicio" value="<?php echo $vfechaini;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Servicio Hasta:</label>
							<input type="text" name="fechahasta" class="form-control" id="fechahasta" placeholder="Introduce la fecha de fin de servicio" value="<?php echo $vfechahasta;?>">
						</div>
						<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="idcli" name="idcli" value="<?php echo $idcli;?>" />
						<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
						</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
					<label color="White" type="text">&nbsp;</label><br><label color="White" type="text">&nbsp;</label><br><label color="White" type="text">&nbsp;</label><hr>
					<a href="consultarformularios.php"><span class="glyphicon glyphicon-share-alt" aria-hidden="true">Volver</span></a>
				</div>
			</div>
			<br><br>
		</div>
	</div>
	<br><br>
</div>
	<!-- /#wrapper -->
	<!-- Carga de Provincias y Localidades -->
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
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#fechaini').datepicker({
				format: "dd/mm/yyyy", 
				endDate: "+0d",
				autoclose: true,
			}); 
			 
		});
	</script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#fechahasta').datepicker({
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
	<script type="text/javascript">
	function deshab() {
	  frm = document.forms['frmcarga'];
	  for(i=0; ele=frm.elements[i]; i++)
		ele.disabled=true;
	}
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
												if(document.getElementById("nacidoen").value.trim() != ""){
													if(document.getElementById("localidad").value.trim() != ""){
														if(document.getElementById("viveen").value.trim() != ""){
															if(document.getElementById("localidadviveen").value.trim() != ""){
																if(document.getElementById("cpostal").value.trim() != ""){
																	if(document.getElementById("telefono").value.trim() != ""){
																		if(document.getElementById("celular").value.trim() != ""){
																			if(document.getElementById("email").value.trim() != ""){
																				if(document.getElementById("formapago").value.trim() != ""){
																					if(document.getElementById("domicobrador").value.trim() != ""){
																						if(document.getElementById("barriocobrador").value.trim() != ""){
																							if(document.getElementById("provcobrador").value.trim() != ""){
																								if(document.getElementById("localidadcobra").value.trim() != ""){
																									if(document.getElementById("zona").value.trim() != 0){
																										if(document.getElementById("libro").value.trim() != ""){
																											if(document.getElementById("acta").value.trim() != ""){
																												if(document.getElementById("categorias").value.trim() != ""){
																													if(document.getElementById("embarca").value.trim() != ""){
																														if(document.getElementById("situmilitar").value.trim() != ""){
																															if(document.getElementById("grado").value.trim() != ""){
																																if(document.getElementById("fuerza").value.trim() != ""){
																																	if(document.getElementById("escalafon").value.trim() != ""){
																																		if(document.getElementById("promovidopor").value.trim() != ""){
																																			if(document.getElementById("provmil").value.trim() != ""){
																																				if(document.getElementById("localidadmil").value.trim() != ""){
																																					if(document.getElementById("fechaini").value.trim() != ""){
																																						if(document.getElementById("fechahasta").value.trim() != ""){
																																							document.getElementById('frmcarga').submit();
																																						}else{
																																							alert("Debe seleccionar una fecha de fin de servicio");
																																						}
																																					}else{
																																						alert("Debe seleccionar una fecha de inicio de servicio");
																																					}
																																				}else{
																																					alert("Debe seleccionar una localidad");
																																				}
																																			}else{
																																				alert("Debe seleccionar una provincia");
																																			}
																																		}else{
																																			alert("Debe indicar un promotor");
																																		}
																																	}else{
																																		alert("Debe ingresar un escalafon");
																																	}
																																}else{
																																	alert("Debe ingresar una fuerza");
																																}
																															}else{
																																alert("Debe ingresar un grado");
																															}
																														}else{
																															alert("Debe seleccionar una situacion militar");
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