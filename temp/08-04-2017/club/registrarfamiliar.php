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
	<!-- datetimepicker -->
	<link href="css/datepicker.css" rel="stylesheet">
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
					<h2><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Registrar Familiar</h2>
					<br>
					<form id="frmcarga" name="frmcarga" method="post" action="registrarfamiliar_post.php">
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Codigo de Afiliado:</label>
						<div class="col-sm-12">
						  <input type="text" name="codigoafilia" class="form-control" id="codigoafilia" onkeydown="return validarNumeros(event)" placeholder="Introduce un codigo de afiliado" value="<?php echo $vcodigoafilia;?>">
						</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-search"></span>&nbsp;Parentesco:</label>
							<div class="col-sm-12">
								<select class="form-control" name="parentesco" id="parentesco" value="<?php echo $vtipoparentesco;?>">
									<option value="0"> - Seleccione - </option>
									<option value="HI">Hijo/a</option>
									<option value="C">Conyuge</option>
									<option value="H">Hermano/a</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Nombre de Pariente:</label>
						<div class="col-sm-12">
						  <input type="text" name="nompariente" class="form-control" id="nompariente" placeholder="Nombre del pariente" value="<?php echo $vnombrepariente;?>">
						</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Apellido de Pariente:</label>
						<div class="col-sm-12">
						  <input type="text" name="apepariente" class="form-control" id="apepariente" placeholder="Apellido del pariente" value="<?php echo $vapellidopariente;?>">
						</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="col-sm-12 control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;DNI de Pariente:</label>
						<div class="col-sm-12">
						  <input type="text" name="dnipariente" class="form-control" id="dnipariente" onkeydown="return validarNumeros(event)" placeholder="DNI del pariente" value="<?php echo $vdnipariente;?>">
						</div>
						</div>
						<div class="col-lg-4 col-md-6 form-group text-center">
						<label for="title" class="control-label"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Fecha de Nacimiento:</label>
							<input type="text" name="fechanac" class="form-control" id="fechanac" placeholder="Introduce la fecha de nacimiento" value="<?php echo $vfechanac;?>">
						</div>
						<div style="padding-left:15px;padding-right:15px">
							<input type="hidden" id="qhacemos" name="qhacemos" value="<?php echo $qhacemos;?>" />
							<input type="hidden" id="idcli" name="idcli" value="<?php echo $idcli;?>" />
							<div id="retorno" name="retorno" style="font-size:20px; color:#F60; background-color:#fff" class="pull-left"><?php if(isset($_GET['retorno'])){ echo $_GET['retorno'];}?></div>
							<input style="margin-top: 10px; text-align:center" id="cargar" name="cargar" type="button" class="pull-right botoncss" value="Guardar" >
						</div>
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
	<!-- Date Time Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
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
				if(document.getElementById("codigoafilia").value.trim() != ""){
					if(document.getElementById("parentesco").value.trim() != 0){
						if(document.getElementById("nompariente").value.trim() != ""){
							if(document.getElementById("apepariente").value.trim() != ""){
								if(document.getElementById("dnipariente").value.trim() != ""){
									if(document.getElementById("fechanac").value.trim() != ""){
										document.getElementById('frmcarga').submit();
									}else{
										alert("Debe seleccionar la fecha de nacimiento del pariente");
									}
								}else{
									alert("Debe ingresar el dni del pariente");
								}
							}else{
								alert("Debe ingresar el apellido del pariente");
							}
						}else{
							alert("Debe ingresar el nombre del pariente");
						}
					}else{
						alert("Debe seleccionar el parentesco");
					}
				}else{
						alert("Debe ingresar el codigo del afiliado");
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