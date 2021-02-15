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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Carga de Embarcaciones</h2>
					<hr>
					<form id="frmcarga" name="frmcarga" method="post" action="registrarembarcacion_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Codigo de Socio:</label>
							<input type="text" name="codigosocio" class="form-control" id="codigosocio" onkeydown="return validarNumeros(event)" placeholder="Introduce un codigo" value="<?php echo $vcodigosocio;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre Embarcacion:</label>
							<input type="text" name="nombreemb" class="form-control" id="nombreemb" placeholder="Introduce un nombre" value="<?php echo $vnombreemb;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Arboladura:</label>
							<input type="text" name="arboladura" class="form-control" id="arboladura" onkeydown="return validarNumeros(event)" placeholder="Introduce una arboladura" value="<?php echo $varboladura;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Marca Motor:</label>
							<input type="text" name="marcamotor" class="form-control" id="marcamotor" placeholder="Introduce una marca" value="<?php echo $vmarcamotor;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Potencia Motor:</label>
							<input type="text" name="potmotor" class="form-control" id="potmotor" placeholder="Introduce una potencia" value="<?php echo $vpotmotor;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Tonelaje:</label>
							<input type="text" name="tonelaje" class="form-control" id="tonelaje" onkeydown="return validarNumeros(event)" placeholder="Introduce un tonelaje" value="<?php echo $vtonelaje;?>">
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
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Calado:</label>
							<input type="text" name="calado" class="form-control" id="calado" onkeydown="return validarNumeros(event)" placeholder="Introduce un calado" value="<?php echo $vvalado;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Matricula:</label>
							<input type="text" name="matricula" class="form-control" id="matricula" onkeydown="return validarNumeros(event)" placeholder="Introduce una matricula" value="<?php echo $vmatricula;?>">
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha Ultima Inspeccion:</label>
							<input type="text" name="fechainsp" class="form-control" id="fechainsp" placeholder="Introduce la fecha de nacimiento" value="<?php echo $vfechanac;?>">
						</div>
						<div style="padding-left:15px;padding-right:15px">
						<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
						<input type="hidden" id="idu" name="idu" value="<?php echo $idu;?>" />
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
				format: "dd/mm/yyyy", 
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
			if(document.getElementById("codigosocio").value.trim() != ""){
				 if(document.getElementById("nombreemb").value.trim() != ""){
					if(document.getElementById("arboladura").value.trim() != ""){
						if(document.getElementById("marcamotor").value.trim() != ""){
							if(document.getElementById("potmotor").value.trim() != ""){
								if(document.getElementById("tonelaje").value.trim() != ""){
									if(document.getElementById("eslora").value.trim() != ""){
										if(document.getElementById("manga").value.trim() != ""){
											if(document.getElementById("calado").value.trim() != ""){
												if(document.getElementById("matricula").value.trim() != ""){
													if(document.getElementById("fechainsp").value.trim() != ""){
														document.getElementById('frmcarga').submit();
													}else{
														alert("Debe ingresar la fecha de la ultima inspeccion ");
													}
												}else{
													alert("Debe ingresar la matricula");
												}
											}else{
												alert("Debe ingresar el calado");
											}
										}else{
											alert("Debe ingresar la manga");
										}
									}else{
										alert("Debe ingresar la eslora");
									}
								}else{
									alert("Debe ingresar el tonelaje");
								}
							} else{
							 alert("Debe escribir la potencia del motor");
							}
						}else{
							alert("Debe ingresar la marca del motor");
						}
					}else{
						alert("Debe escribir la arboladura");
					}
				}else{
					alert("Debe ingresar el nombre");
					}
			}else{
				alert("Debe ingresar el codigo");
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