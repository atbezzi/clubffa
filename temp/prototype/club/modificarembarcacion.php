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
	
	error_reporting (0); //ocultar "notice"
	mysql_query('SET CHARACTER SET utf8'); //oro en polvo
	$qhacemos = "nuevo";
	$ide = $_REQUEST['ide'];
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
				$resp = mysql_query("select e.nombre as nombre, e.arboladura as arboladura, e.casco as casco, e.eslora as eslora, e.manga as manga, e.puntal as puntal, 
				e.calado as calado, e.tonelaje as tonelaje, e.motormarca as motormarca, e.motornumero as motornumero, e.motorpotencia as motorpotencia, e.matricula as matricula, 
				e.rey as rey, e.inspeccion as inspeccion, e.elementos as elementos, s.nsocio as nsocio from embarcaciones e inner join socios s on s.id = e.socio_id 
				where e.id = $ide");
				while($datos = mysql_fetch_array($resp)) {
					$qhacemos="modifica";
					$vnombreemb = $datos['nombre'];
					$varboladura = $datos['arboladura'];
					$vcasco = $datos['casco'];
					$veslora = $datos['eslora'];
					$vmanga = $datos['manga'];
					$vpuntal = $datos['puntal'];
					$vcalado = $datos['calado'];
					$vtonelaje = $datos['tonelaje'];
					$vmarcamotor = $datos['motormarca'];
					$vnumeromotor = $datos['motornumero'];
					$vpotmotor = $datos['motorpotencia'];
					$vmatricula = $datos['matricula'];
					$vrey = $datos['rey'];
					$vfechainsp = $datos['inspeccion'];
					$vcodigosocio = $datos['nsocio'];
					$velementos = $datos['elementos'];
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Modificar embarcación</h2>
					<hr>
					<form id="frmcarga" name="frmcarga" method="post" action="modificarembarcacion_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre embarcación:</label>
							<input type="text" name="nombreemb" class="form-control" id="nombreemb" placeholder="Introduce un nombre" value="<?php echo $vnombreemb;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Arboladura:</label>
							<input type="text" name="arboladura" class="form-control" id="arboladura" placeholder="Introduce una arboladura" value="<?php echo $varboladura;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Casco:</label>
							<input type="text" name="casco" class="form-control" id="casco" placeholder="Introduce un casco" value="<?php echo $vcasco;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Eslora:</label>
							<input type="text" name="eslora" class="form-control" id="eslora" onkeydown="return validarNumeros(event)" placeholder="Introduce una eslora" value="<?php echo $veslora;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Manga:</label>
							<input type="text" name="manga" class="form-control" id="manga" onkeydown="return validarNumeros(event)" placeholder="Introduce una manga" value="<?php echo $vmanga;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Puntal:</label>
							<input type="text" name="puntal" class="form-control" id="puntal" onkeydown="return validarNumeros(event)" placeholder="Introduce una manga" value="<?php echo $vpuntal;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Calado:</label>
							<input type="text" name="calado" class="form-control" id="calado" onkeydown="return validarNumeros(event)" placeholder="Introduce un calado" value="<?php echo $vcalado;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Tonelaje:</label>
							<input type="text" name="tonelaje" class="form-control" id="tonelaje" onkeydown="return validarNumeros(event)" placeholder="Introduce un tonelaje" value="<?php echo $vtonelaje;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Marca motor:</label>
							<input type="text" name="marcamotor" class="form-control" id="marcamotor" placeholder="Introduce una marca de motor" value="<?php echo $vmarcamotor;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Número motor:</label>
							<input type="text" name="numeromotor" class="form-control" id="numeromotor" placeholder="Introduce una numero de motor" value="<?php echo $vnumeromotor;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Potencia motor:</label>
							<input type="text" name="potmotor" class="form-control" id="potmotor" onkeydown="return validarNumeros(event)" placeholder="Introduce una potencia" value="<?php echo $vpotmotor;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Matrícula:</label>
							<input type="text" name="matricula" class="form-control" id="matricula" placeholder="Introduce una matricula" value="<?php echo $vmatricula;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Rey:</label>
							<input type="text" name="rey" class="form-control" id="rey" placeholder="Introduce un rey" value="<?php echo $vrey;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha última inspección:</label>
							<input type="text" name="fechainsp" class="form-control" id="fechainsp" placeholder="Introduce la fecha de nacimiento" value="<?php echo $vfechainsp;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;N° de socio:</label>
							<input type="text" name="codigosocio" class="form-control" id="codigosocio" onkeydown="return validarNumeros(event)" placeholder="Introduce un codigo" value="<?php echo $vcodigosocio;?>" disabled="disabled">
						</div>
						<div class="col-sm-12">
							<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Elementos:</label>
							<textarea class="form-control" rows="5" style="overflow:auto;resize:none" name="elementos" id="elementos" placeholder="Introduce un elementos" value="<?php echo $velementos;?>"><?php echo $velementos;?></textarea>
						</div>
						<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="ide" name="ide" value="<?php echo $ide;?>" />
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
	<!-- Date Time Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
		// When the document is ready
		$(document).ready(function ()
		{
			$('#fechainsp').datepicker({
				format: "yyyy-mm-dd", 
				endDate: "+0d",
				autoclose: true,
			}); 
			 
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
		jQuery('#frmcarga').on('click', '#cargar', function(event) {
			if(document.getElementById("nombreemb").value.trim() != ""){
				 if(document.getElementById("arboladura").value.trim() != ""){
					if(document.getElementById("casco").value.trim() != ""){
						if(document.getElementById("eslora").value.trim() != ""){
							if(document.getElementById("manga").value.trim() != ""){
								if(document.getElementById("puntal").value.trim() != ""){
									if(document.getElementById("calado").value.trim() != ""){
										if(document.getElementById("tonelaje").value.trim() != ""){
											if(document.getElementById("marcamotor").value.trim() != ""){
												if(document.getElementById("numeromotor").value.trim() != ""){
													if(document.getElementById("potmotor").value.trim() != ""){
														if(document.getElementById("matricula").value.trim() != ""){
															if(document.getElementById("rey").value.trim() != ""){
																if(document.getElementById("fechainsp").value.trim() != ""){
																	if(document.getElementById("codigosocio").value.trim() != ""){
																		if(document.getElementById("elementos").value.trim() != ""){
																			document.getElementById('frmcarga').submit();
																		}else{
																			alert("Debe ingresar los elementos");
																		}
																	}else{
																		alert("Debe ingresar un codigo de socio valido");
																	}
																}else{
																	alert("Debe ingresar la fecha de la ultima inspeccion");
																}
															}else{
																alert("Debe ingresar el rey");
															}
														}else{
															alert("Debe ingresar la matricula");
														}
													}else{
														alert("Debe ingresar la potencia del motor");
													}
												}else{
													alert("Debe ingresar el numero del motor");
												}
											}else{
												alert("Debe ingresar la marca del motor");
											}
										}else{
											alert("Debe ingresar el tonelaje");
										}
									}else{
										alert("Debe ingresar el calado");
									}
								}else{
									alert("Debe ingresar el puntal");
								}
							} else{
							 alert("Debe escribir la manga");
							}
						}else{
							alert("Debe ingresar la eslora");
						}
					}else{
						alert("Debe ingresar el casco");
					}
				}else{
					alert("Debe ingresar la arboladura");
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