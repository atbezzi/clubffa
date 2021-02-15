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
	
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	
	error_reporting (0); //ocultar "notice"
	
	$vnombre="";
	$vapellido="";
	$vnacidoen="";
	$vlocalidad="";
	$vfechanac="";
	$vdni="";
	$vcalle="";
	$vnumerocalle="";
	$vpisodpto="";
	$vdpto="";
	$vbarrio="";
	$vcpostal="";
	$vtelefono="";
	$vcelular="";
	$vemail="";
	$vclave="";
	
/*	if($_SESSION['tipo'] != 'A'){
	header("location:index.php?retorno=no_acess");
	} else{
		
	}

	$qhacemos="nuevo";
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Datos Personales del Usuario</h2>
					<hr>
					<form id="frmcarga" name="frmcarga" method="post" action="datosusuarios_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre:</label>
							<input type="text" name="nombre" class="form-control" id="nombre" placeholder="Introduce un nombre" value="<?php echo $vnombre;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Apellido:</label>
							<input type="text" name="apellido" class="form-control" id="apellido" placeholder="Introduce un apellido" value="<?php echo $vapellido;?>">
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
							<option value="<?php echo $fila['id']; ?>"><?php echo $fila['provincia']; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center" id="myDiv">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Localidad:</label>
							<select type="text" name="localidad" class="form-control" id="localidad" placeholder="Seleccione la localidad" value="<?php echo $vlocalidad;?>"></select>
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
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre de la Calle:</label>
							<input type="text" name="calle" class="form-control" id="calle" placeholder="Introduce la calle" value="<?php echo $vcalle;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;N° de calle:</label>
							<input type="text" name="numerocalle" class="form-control" id="numerocalle" onkeydown="return validarNumeros(event)" placeholder="Introduce un numero de calle" value="<?php echo $vnumerocalle;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Piso:</label>
							<input type="text" name="pisodpto" class="form-control" id="pisodpto" onkeydown="return validarNumeros(event)" placeholder="Introduce un piso" value="<?php echo $vpisodpto;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Dpto:</label>
							<input type="text" name="dpto" class="form-control" id="dpto" placeholder="Introduce departamento" value="<?php echo $vdpto;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Barrio:</label>
							<input type="text" name="barrio" class="form-control" id="barrio" placeholder="Introduce el nombre del barrio" value="<?php echo $vbarrio;?>">
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
						<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="idcli" name="idcli" value="<?php echo $idcli;?>" />
						<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
						<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Guardar" >
						</div>
						<input type="hidden" id="usuariocarga" name="usuariocarga" value="<?php echo $_SESSION['usuario']; ?>">
					</form>
				</div>
			</div>
			<br><br>
		</div>
	</div>
	<div class="row" style="max-width:100%; margin-left:0px; margin-right:0px;">
		<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
		</div>
		<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
			<div class="content"><br><br><br>
			<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Cambiar Clave</h2>
			<hr>
			<form id="frmmodificapass" name="frmmodificapass" method="post" action="datosusuariospass_post.php">
				<div class="col-lg-8 col-md-6 form-group text-center">
				<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Clave:</label>
					<input type="text" name="clave" class="form-control" id="clave" placeholder="Introduce un nueva clave" value="<?php echo $vclave;?>">
				</div>
				<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="idcli" name="idcli" value="<?php echo $idcli;?>" />
						<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
						<input style="margin-top: 10px; text-align:center" id="cargarclave" name="cargarclave" type="button" class="pull-right botoncss" value="Modificar" >
						</div>
			</div>
			</form>
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
	<script type="text/javascript">
			jQuery('#frmmodificapass').on('click', '#cargarclave', function(event) {
				if(document.getElementById("clave").value.trim() != ""){
					document.getElementById('frmmodificapass').submit();
				}else{
					alert("Debe ingresar una clave");
			});
	</script>
	<script type="text/javascript">
			jQuery('#frmcarga').on('click', '#cargar', function(event) {
				if(document.getElementById("nombre").value.trim() != ""){
					 if(document.getElementById("apellido").value.trim() != ""){
						if(document.getElementById("nacidoen").value.trim() != ""){
							if(document.getElementById("fechanac").value.trim() != ""){
								if(document.getElementById("dni").value.trim() != ""){
									if(document.getElementById("calle").value.trim() != ""){
										if(document.getElementById("numerocalle").value.trim() != ""){
											if(document.getElementById("pisodpto").value.trim() != ""){
												if(document.getElementById("dpto").value.trim() != ""){
													if(document.getElementById("barrio").value.trim() != ""){
														if(document.getElementById("localidad").value.trim() != ""){
															if(document.getElementById("cpostal").value.trim() != ""){
																if(document.getElementById("telefono").value.trim() != ""){
																	if(document.getElementById("celular").value.trim() != ""){
																		if(document.getElementById("email").value.trim() != ""){
																			document.getElementById('frmcarga').submit();
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
															alert("Debe ingresar el nombre de la localidad");
														}
													}else{
														alert("Debe ingresar el nombre del barrio");
													}
												}else{
													alert("Debe ingresar el dpto");
												}
											}else{
												alert("Debe ingresar el piso del dpto");
											}
										}else{
											alert("Debe ingresar el numero de la calle");
										}
									}else{
										alert("Debe ingresar el nombre de la calle");
									}
								}else{
									alert("Debe ingresar el dni");
								}
							} else {
							 alert("Debe escribir la fecha de nacimiento");
							}
						}else{
							alert("Debe escribir el lugar de nacimiento");
						}
					}else{
						alert("Debe ingresar la apellido");
						}
				}else{
					alert("Debe ingresar el nombre");
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